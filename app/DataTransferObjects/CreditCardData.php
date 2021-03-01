<?php

namespace App\DataTransferObjects;

use DateTimeInterface;
use Spatie\DataTransferObject\DataTransferObject;

class CreditCardData extends DataTransferObject
{
    /**
     * Name of the payment gateway provider
     *
     * @example "paylike"
     * @var string
     */
    public string $gateway;

    /**
     * ID From the gateway provider
     *
     * @var string
     */
    public string $id;

    /**
     * The credit card scheme / brand
     *
     * @example "visa"
     * @var string
     */
    public string $brand;

    /**
     * The first 6 numbers
     *
     * @var string
     */
    public string $bin;

    /**
     * The last 4 numbers
     *
     * @var string
     */
    public string $last_four;

    /**
     * DateTime it was created at the gateway provider
     *
     * @var DateTimeInterface
     */
    public DateTimeInterface $created_at;

    /**
     * DateTime the credit card expires at
     *
     * @var ?DateTimeInterface
     */
    public ?DateTimeInterface $expires_at;
}
