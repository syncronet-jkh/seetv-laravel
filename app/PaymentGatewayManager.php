<?php

namespace App;

use App\Services\FreePaymentGateway;
use App\Services\PaylikePaymentGateway;
use Illuminate\Support\Collection;
use Illuminate\Support\Manager;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Paylike\Paylike;
use function collect;
use function get_class_methods;
use function str_replace;

class PaymentGatewayManager extends Manager
{
    protected static ?Collection $optionsCache = null;
    protected string $defaultDriver = 'Paylike';

    /**
     * The available driver options
     *
     * @return \Illuminate\Support\Collection<string>
     */
    public function options()
    {
        if (self::$optionsCache) {
            return self::$optionsCache;
        }

        return self::$optionsCache = collect(get_class_methods($this))
            ->filter(fn (string $method) => $method !== 'createDriver' && Str::is('create*Driver', $method))
            ->map(fn (string $method) => str_replace('Driver', '', Str::after($method, 'create')))
            ->values()
            ->merge(array_keys($this->customCreators));
    }

    public function getDefaultDriver()
    {
        return $this->defaultDriver;
    }

    public function createPaylikeDriver()
    {
        return new PaylikePaymentGateway(
            new Paylike($this->config->get('services.paylike.app_id')),
            $this->config->get('services.paylike.merchant_id')
        );
    }

    public function createFreeDriver()
    {
        return new FreePaymentGateway();
    }
}
