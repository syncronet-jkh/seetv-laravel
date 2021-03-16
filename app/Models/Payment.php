<?php

namespace App\Models;

use App\Contracts\PaymentGateway;
use App\PaymentGatewayManager;
use Brick\Money\Context\CustomContext;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Currencies;
use function app;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function statuses()
    {
        return $this->hasMany(PaymentStatus::class);
    }

    public function toMoney()
    {
        return Money::of(
            $this->amount,
            $this->currency,
            new CustomContext(Currencies::getFractionDigits($this->currency))
        );
    }

    public function gateway(): ?PaymentGateway
    {
        return app(PaymentGatewayManager::class)->driver($this->gateway);
    }

    public function creditCard()
    {
        return $this->gateway()->fetchCard($this);
    }

    public function authorize()
    {
        return $this->gateway()->authorize($this);
    }

    public function charge()
    {
        $captureId = $this->gateway()->capture($this);

        $this->statuses()->create([
            'value' => PaymentStatus::CAPTURED,
            'gateway' => $this->gateway,
            'gateway_id' => $captureId
        ]);

        return $this;
    }

    public function refund()
    {
        $refundId = $this->gateway()->refund($this);

        $this->statuses()->create([
            'value' => PaymentStatus::REFUNDED,
            'gateway' => $this->gateway,
            'gateway_id' => $refundId
        ]);

        return $this;
    }
}
