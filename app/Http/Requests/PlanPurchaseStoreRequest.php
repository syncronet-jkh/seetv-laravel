<?php

namespace App\Http\Requests;

use App\Models\Plan;
use App\Models\Payment;
use App\Rules\SupportedPaymentGateway;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PlanPurchaseStoreRequest extends FormRequest
{
    private ?Plan $plan = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function currency(): string
    {
        return $this->input('currency', 'DKK');
    }

    public function gateway(): string
    {
        return $this->input('gateway', 'Free');
    }

    public function payment(): Payment
    {
        $payment = new Payment($this->validated());
        $payment->plan()->associate($this->plan());
        $payment->price()->associate($this->plan()->prices->first());
        $payment->gateway = $this->gateway();
        $payment->currency = $this->currency();
        $payment->authorize_id = $this->input('authorize_id', fn () => $payment->authorize());
        $payment->amount = optional($payment->price)->amount ?? 0;
        $payment->description = "{$this->plan()->role->name} {$this->plan()->title} Plan was purchased.";

        return $payment;
    }

    public function plan(): Plan
    {
        return $this->plan ??= Plan::with([
            'prices' => fn ($prices) => $prices->where('currency', $this->currency())
        ])->findOrFail($this->route('plan'));
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->sometimes('gateway', 'required', fn () => !$this->plan()->is_free);
        $validator->sometimes('currency', 'required', fn () => !$this->plan()->is_free);
        $validator->sometimes('authorize_id', 'required', fn () => !$this->plan()->is_free);

        $validator->after(function (Validator $validator) {
            if (strtolower($this->gateway()) === 'free' && !$this->plan()->is_free) {
                $validator->errors()->add('gateway', __('Cannot use Free gateway for a paid plan.'));
            }
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gateway' => ['string', 'max:255', new SupportedPaymentGateway],
            'currency' => ['string', 'max:255'],
            'authorize_id' => ['string', 'max:255'],
            'credit_card_id' => ['nullable', 'string', 'max:255']
        ];
    }
}
