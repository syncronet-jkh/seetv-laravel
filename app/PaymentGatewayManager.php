<?php

namespace App;

use App\Services\PaylikePaymentGateway;
use Illuminate\Support\Manager;
use Illuminate\Support\Str;
use Paylike\Paylike;
use function collect;
use function get_class_methods;
use function str_replace;

class PaymentGatewayManager extends Manager
{
    /**
     * The available driver options
     *
     * @return \Illuminate\Support\Collection<string>
     */
    public function options()
    {
        return collect(get_class_methods($this))
            ->filter(fn (string $method) => $method !== 'createDriver' && Str::is('create*Driver', $method))
            ->map(fn (string $method) => str_replace('Driver', '', Str::after($method, 'create')))
            ->values()
            ->merge(array_keys($this->customCreators));
    }

    public function getDefaultDriver()
    {
        return 'paylike';
    }

    public function createPaylikeDriver()
    {
        return new PaylikePaymentGateway(
          new Paylike($this->config->get('services.paylike.app_id')),
          $this->config->get('services.paylike.merchant_id')
        );
    }
}
