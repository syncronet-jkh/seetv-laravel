<?php

namespace App\Http\Requests;

use App\Models\Plan;
use App\Rules\SupportedPaymentGateway;
use Illuminate\Foundation\Http\FormRequest;

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

    public function plan(): Plan
    {
        return $this->plan ??= Plan::with([
            'prices' => fn ($prices) => $prices->where('currency', $this->input('currency', 'DKK'))
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
