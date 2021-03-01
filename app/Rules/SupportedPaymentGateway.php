<?php

namespace App\Rules;

use App\PaymentGatewayManager;
use Illuminate\Contracts\Validation\Rule;
use InvalidArgumentException;
use function app;
use function trans;

class SupportedPaymentGateway implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            app(PaymentGatewayManager::class)->driver($value);

            return true;
        } catch (InvalidArgumentException $driverNotSupported) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.in_array', ['other' => app(PaymentGatewayManager::class)->options()]);
    }
}
