<?php

namespace App\Services;

use Ramsey\Uuid\Uuid;
use App\Models\Payment;
use App\Contracts\PaymentGateway;
use App\DataTransferObjects\CreditCardData;
use App\Exceptions\PaymentGatewayException;

class FreePaymentGateway implements PaymentGateway
{
    public function fetchCard(Payment $payment): CreditCardData
    {
        throw PaymentGatewayException::notSupported($this, __FUNCTION__);
    }

    public function saveCard(Payment $payment): string
    {
        throw PaymentGatewayException::notSupported($this, __FUNCTION__);
    }

    public function authorize(Payment $payment): string
    {
        return (string)Uuid::uuid4();
    }

    public function capture(Payment $payment): string
    {
        return $payment->authorize_id;
    }

    public function refund(Payment $payment): string
    {
        return $payment->authorize_id;
    }
}
