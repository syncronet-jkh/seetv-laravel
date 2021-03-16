<?php

namespace App\Exceptions;

use App\Contracts\PaymentGateway;
use App\Models\Payment;
use RuntimeException;
use function __;
use function class_basename;

class PaymentGatewayException extends RuntimeException
{
    const MISSING_CREDIT_CARD_ID = 'Payment[:id] is missing a credit card id';
    const NOT_SUPPORTED = ':method is not supported by :gateway.';

    public static function missingCreditCardId(Payment $payment)
    {
        return __(self::MISSING_CREDIT_CARD_ID, ['id' => $payment->getKey()]);
    }

    public static function notSupported(PaymentGateway $gateway, string $method)
    {
        return __(self::NOT_SUPPORTED, ['method' => $method, 'gateway' => class_basename($gateway)]);
    }
}
