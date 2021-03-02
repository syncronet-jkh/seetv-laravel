<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Plan;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $viewer = Role::findByName(Role::VIEWER);
        $distributor = Role::findByName(Role::DISTRIBUTOR);
        $streamer = Role::findByName(Role::PUBLISHER);

        $this->createFreeViewer($viewer);

        $this->createViewerSubscription($viewer);

        $this->createDistributorMulti50($distributor);

        $this->createDistributorMulti200($distributor);

        $this->createDistributorMulti200Plus($distributor);

        $this->createStreamerStandard($streamer);

        $this->createStreamerProStandard($streamer);

        $this->createStreamerPro($streamer);
    }

    private function createFreeViewer($role): void
    {
        $viewerFree = Plan::create([
            'title' => "Free",
            'role_id' => $role->getKey(),
            'binding_period' => null,
        ]);
        $viewerFree->setTranslation('title', 'da', 'Gratis');

        $viewerFree->deny(Permission::AD_FREE);

        $viewerFree->allow(
            Permission::VIEW_CONTENT,
            Permission::TV_GUIDE
        );
    }

    private function createViewerSubscription($role): void
    {
        $viewerSubscription = Plan::create([
            'title' => 'Viewer Subscription',
            'role_id' => $role->getKey(),
            'binding_period' => Plan::BINDING_PERIOD_1_MONTH,
        ]);
        $viewerSubscription->setTranslation('title', 'da', 'Seer Abonnement');
        $viewerSubscription->allow(
            Permission::AD_FREE,
            Permission::VIEW_CONTENT,
            Permission::TV_GUIDE
        );
        $viewerSubscription->prices()->create([
            'currency' => 'DKK',
            'amount' => 32.50
        ]);
    }

    private function createDistributorMulti50($role): void
    {
        $distributorMulti50 = Plan::create([
            'title' => 'Multi50 DUR**',
            'role_id' => $role->getKey(),
            'binding_period' => Plan::BINDING_PERIOD_1_MONTH,
        ]);

        $distributorMulti50->allow(
            Permission::FIFTY_VIEWERS
        );
        $distributorMulti50->prices()->create([
            'currency' => 'DKK',
            'amount' => 399
        ]);
    }

    private function createDistributorMulti200($role): void
    {
        $distributorMulti200 = Plan::create([
            'title' => 'Multi200 DUR**',
            'role_id' => $role->getKey(),
            'binding_period' => Plan::BINDING_PERIOD_1_MONTH,
        ]);

        $distributorMulti200->allow(
            Permission::TWO_HUNDRED_VIEWERS
        );

        $distributorMulti200->prices()->create([
            'currency' => 'DKK',
            'amount' => 999
        ]);
    }

    private function createDistributorMulti200Plus($role): void
    {
        $distributorMulti200Plus = Plan::create([
            'title' => 'Multi200+ DUR**',
            'role_id' => $role->getKey(),
            'binding_period' => Plan::BINDING_PERIOD_1_MONTH,
        ]);

        $distributorMulti200Plus->allow(
            Permission::MORE_THAN_TWO_HUNDRED_VIEWERS
        );

        $distributorMulti200Plus->prices()->create([
            'currency' => 'DKK',
            'amount' => 1299
        ]);
    }

    private function createStreamerStandard($streamer): void
    {
        $streamerStandard = Plan::create([
            'title' => 'Standard',
            'role_id' => $streamer->getKey(),
            'binding_period' => Plan::BINDING_PERIOD_1_MONTH,
        ]);

        $streamerStandard->allow(
            Permission::FIVE_HOURS_PER_MONTH
        );

        $streamerStandard->deny(
            Permission::EMBED_ON_OWN_WEBSITE,
            Permission::OPEN_FOR_OBS
        );

        $streamerStandard->prices()->create([
            'currency' => 'DKK',
            'amount' => 625
        ]);
    }

    private function createStreamerProStandard($streamer): void
    {
        $streamerProStandard = Plan::create([
            'title' => 'Pro-Standard',
            'role_id' => $streamer->getKey(),
            'binding_period' => Plan::BINDING_PERIOD_1_MONTH,
        ]);

        $streamerProStandard->allow(
            Permission::THIRTY_HOURS_PER_MONTH,
            Permission::EMBED_ON_OWN_WEBSITE,
            Permission::OPEN_FOR_OBS
        );

        $streamerProStandard->prices()->create([
            'currency' => 'DKK',
            'amount' => 3125
        ]);
    }

    private function createStreamerPro($streamer): void
    {
        $streamerPro = Plan::create([
            'title' => 'Pro',
            'role_id' => $streamer->getKey(),
            'binding_period' => Plan::BINDING_PERIOD_1_MONTH,
        ]);

        $streamerPro->allow(
            Permission::STREAM_ALL_THE_TIME,
            Permission::EMBED_ON_OWN_WEBSITE,
            Permission::OPEN_FOR_OBS
        );

        $streamerPro->prices()->create([
            'currency' => 'DKK',
            'amount' => 6250
        ]);
    }
}
