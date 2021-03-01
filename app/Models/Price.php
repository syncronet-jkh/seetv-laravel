<?php

namespace App\Models;

use Brick\Money\Context\CustomContext;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Currencies;
use function money;

class Price extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function toMoney()
    {
        return Money::of(
            $this->amount,
            $this->currency,
            new CustomContext(Currencies::getFractionDigits($this->currency))
        );
    }
}
