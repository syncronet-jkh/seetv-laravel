<?php

namespace App\Contracts;

use App\DataTransferObjects\CreditCardData;
use App\Exceptions\PaymentGatewayException;
use App\Models\Payment;

interface PaymentGateway
{
    /**
     * Load a credit card from the provider
     *
     * @throws PaymentGatewayException::missingCreditCardId
     * @param Payment $payment
     * @return CreditCardData
     */
    public function fetchCard(Payment $payment): CreditCardData;

    /**
     * Create a new credit-card object on the provider
     *
     * @param Payment $payment
     * @return string
     */
    public function saveCard(Payment $payment): string;

    /**
     * Create a new transaction from the server-side, that can be captured.
     * As a rule of thumb, this should only be used with a saved credit_card_id, for recurring payments.
     *
     * @param Payment $payment
     * @return string
     */
    public function authorize(Payment $payment): string;

    /**
     * Charge the customers credit card
     *
     * @param Payment $payment
     * @return string
     */
    public function capture(Payment $payment): string;

    /**
     * Refund to the customers credit card
     *
     * @param Payment $payment
     * @return string
     */
    public function refund(Payment $payment): string;
}
