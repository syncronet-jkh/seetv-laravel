<?php

namespace App\Exceptions;

use App\Models\Payment;
use RuntimeException;
use function __;

class PaymentGatewayException extends RuntimeException
{
    const MISSING_CREDIT_CARD_ID = 'Payment[:id] is missing a credit card id';

    public static function missingCreditCardId(Payment $payment)
    {
        return __(self::MISSING_CREDIT_CARD_ID, ['id' => $payment->getKey()]);
    }
}
