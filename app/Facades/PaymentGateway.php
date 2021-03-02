<?php

namespace App\Facades;

use App\PaymentGatewayManager;
use Illuminate\Support\Facades\Facade;

/**
 * Class PaymentGateway
 * @package App\Facades
 * @mixin PaymentGatewayManager
 * @mixin \App\Contracts\PaymentGateway
 */
class PaymentGateway extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PaymentGatewayManager::class;
    }
}
