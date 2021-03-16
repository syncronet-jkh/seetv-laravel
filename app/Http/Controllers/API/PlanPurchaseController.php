<?php

namespace App\Http\Controllers\API;

use function response;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PlanPurchaseStoreRequest;

class PlanPurchaseController
{
    public function store(PlanPurchaseStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            if (!$request->plan()->is_free) {
                $payment = new Payment($request->validated());
                $payment->plan()->associate($request->plan());
                $payment->price()->associate($request->plan()->prices->first());
                $payment->amount = $payment->price->amount;
                $payment->description = "{$request->plan()->role->name} {$request->plan()->title} Plan was purchased.";
                $payment->saveOrFail();
                $payment->charge();
            }

            $request->plan()->assignRoleAndPermissionsTo($request->user());
        });

        return response('', 200);
    }
}
