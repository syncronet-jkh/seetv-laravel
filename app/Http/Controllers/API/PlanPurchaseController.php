<?php

namespace App\Http\Controllers\API;

use function response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PlanPurchaseStoreRequest;

class PlanPurchaseController
{
    public function store(PlanPurchaseStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $payment = $request->payment();
            $payment->saveOrFail();
            $payment->charge();

            $request->plan()->assignRoleAndPermissionsTo($request->user());
        });

        return response('', 200);
    }
}
