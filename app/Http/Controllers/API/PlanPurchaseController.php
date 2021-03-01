<?php

namespace App\Http\Controllers\API;

use App\Models\Payment;
use App\Models\Plan;
use App\Rules\SupportedPaymentGateway;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function response;

class PlanPurchaseController
{
    public function store(Plan $plan, Request $request)
    {
        $validated = $request->validate([
            'gateway' => ['required', 'string', 'max:255', new SupportedPaymentGateway],
            'currency' => ['required', 'string', 'max:255'],
            'authorize_id' => ['required', 'string', 'max:255'],
            'credit_card_id' => ['nullable', 'string', 'max:255']
        ]);

        DB::transaction(function () use ($validated, $plan, $request) {
            $payment = new Payment($validated);
            $payment->plan()->associate($plan);
            $payment->price()->associate($plan->prices()->firstWhere('currency', $validated['currency']));
            $payment->amount = $payment->price->amount;
            $payment->description = "{$plan->role->name} {$plan->title} Plan was purchased.";
            $payment->saveOrFail();
            $payment->charge();

            $plan->assignRoleAndPermissionsTo($request->user());
        });

        return response('', 200);
    }
}
