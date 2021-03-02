<?php

namespace Tests\Unit;

use App\PaymentGatewayManager;
use PHPUnit\Framework\TestCase;
use Tests\__Fakes__\FakePaymentGateway;
use Tests\CreatesApplication;
use function app;

class PaymentGatewayManagerTest extends TestCase
{
    use CreatesApplication;

    public function testItListsTheDriverOptions()
    {
        $app = $this->createApplication();

        /** @var PaymentGatewayManager $manager */
        $manager = $app->make(PaymentGatewayManager::class);
        $manager->extend('fake', fn () => new FakePaymentGateway());

        $drivers = $manager->options();

        self::assertEquals(['Paylike', 'fake'], $drivers->toArray());
    }
}
