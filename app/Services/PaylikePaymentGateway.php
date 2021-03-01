<?php

namespace App\Services;

use App\Contracts\PaymentGateway;
use App\DataTransferObjects\CreditCardData;
use App\Models\Payment;
use Illuminate\Support\Facades\Date;
use Paylike\Paylike;

class PaylikePaymentGateway implements PaymentGateway
{
    protected Paylike $client;
    protected string $merchantId;

    public function __construct(Paylike $paylike, string $merchantId)
    {
        $this->client = $paylike;
        $this->merchantId = $merchantId;
    }

    public function fetchCard(Payment $payment): CreditCardData
    {
        $card = $this->client->cards()->fetch($payment->credit_card_id);

        $data = new CreditCardData();
        $data->gateway = 'paylike';
        $data->id = $card['id'];
        $data->bin = $card['bin'];
        $data->last_four = $card['last4'];
        $data->brand = $card['scheme'];
        $data->created_at = Date::parse($card['created']);
        $data->expires_at = Date::parse($card['expiry']);

        return $data;
    }

    public function saveCard(Payment $payment): string
    {
        return $this->client->cards()->create(
            $this->merchantId,
            ['transaction_id' => $payment->authorize_id]
        );
    }

    /**
     * @see https://github.com/paylike/api-docs#using-a-saved-tokenized-card
     * @param Payment $payment
     * @return string
     */
    public function authorize(Payment $payment): string
    {
        return $this->client->transactions()->create(
            $this->merchantId,
            [
                'cardId' => $payment->credit_card_id,
                'currency' => $payment->toMoney()->getCurrency()->getCurrencyCode(),
                'amount' => $payment->toMoney()->getMinorAmount()->abs()->toInt()
            ]
        );
    }

    public function capture(Payment $payment): string
    {
        $capture = $this->client->transactions()->capture(
            $payment->authorize_id,
            [
                'amount' => $payment->toMoney()->getMinorAmount()->abs()->toInt(),
                'currency' => $payment->toMoney()->getCurrency()->getCurrencyCode(),
                'descriptor' => $payment->description
            ]
        );

        return $capture['id'];
    }

    public function refund(Payment $payment): string
    {
        $refund = $this->client->transactions()->refund(
            $payment->authorize_id,
            [
                'amount' => $payment->toMoney()->getMinorAmount()->abs()->toInt(),
            ]
        );

        return $refund['id'];
    }
}
