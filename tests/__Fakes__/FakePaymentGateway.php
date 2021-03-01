<?php

namespace Tests\__Fakes__;

use App\Contracts\PaymentGateway;
use App\DataTransferObjects\CreditCardData;
use App\Models\Payment;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Testing\Assert;
use Ramsey\Uuid\Uuid;
use Spatie\DataTransferObject\DataTransferObject;
use function now;

class FakePaymentGateway implements PaymentGateway
{
    protected array $savedCards = [];
    protected array $authorizes = [];
    protected array $captures = [];
    protected array $refunds = [];

    public function fetchCard(Payment $payment): CreditCardData
    {
        return Arr::get($this->savedCards, $payment->credit_card_id);
    }

    public function saveCard(Payment $payment): string
    {
        $id = (string)Uuid::uuid4();

        $data = new CreditCardData();
        $data->gateway = 'fake';
        $data->id = $id;
        $data->bin = '411111';
        $data->last_four = '1111';
        $data->brand = 'visa';
        $data->created_at = now();
        $data->expires_at = null;

        $this->savedCards[$id] = $data;

        return $id;
    }

    public function authorize(Payment $payment): string
    {
        $id = (string)Uuid::uuid4();

        $this->authorizes[$id] = $payment;

        return $id;
    }

    public function capture(Payment $payment): string
    {
        $this->captures[$payment->authorize_id] = $payment;

        return $payment->authorize_id;
    }

    public function refund(Payment $payment): string
    {
        $this->refunds[$payment->authorize_id] = $payment;

        return $payment->authorize_id;
    }

    public function assertAuthorized(Closure $callback)
    {
        Assert::assertTrue(
            Arr::first($this->authorizes, $callback) !== null
        );
    }

    public function assertCaptured(Closure $callback)
    {
        Assert::assertTrue(
            Arr::first($this->captures, $callback) !== null
        );
    }

    public function assertRefunded(Closure $callback)
    {
        Assert::assertTrue(
            Arr::first($this->refunds, $callback) !== null
        );
    }
}
