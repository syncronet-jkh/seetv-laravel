<?php

namespace Tests\Feature\Hooks;

use App\GithubSignature;
use App\Jobs\ExecuteDeployment;
use App\Models\Deployment;
use App\Models\SourceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use function response;

class GithubDeploymentTest extends TestCase
{
    use RefreshDatabase;

    public function testItDispatchesTheRunDeploymentJob()
    {
        Bus::fake(ExecuteDeployment::class);

        $sourceProvider = SourceProvider::query()->create([
            'name' => 'Github',
            'deployment_secret' => '6aca922e786bfbd80e7a05dc04af2abeb3bee743'
        ]);

        Http::fake([
            "https://api.github.com/repos/SyncronetDev/seetv-laravel/git/refs/heads/master" => Http::response([
                'object' => [
                    'sha' => '1234-testing'
                ]
            ]),
            "https://api.github.com/repos/syncronet-jkh/seetv-laravel/git/commits/1234-testing" => Http::response([
                'message' => 'Initial Commit'
            ])
        ]);

        $this
            ->postJson(
                '/hooks/Deployments/Github/master',
                [
                    'repository' => [
                      'full_name' => 'SyncronetDev/seetv-laravel',
                      'html_url' => 'https://github.com/SyncronetDev/seetv-laravel'
                    ],
                ],
                ['HTTP_X_HUB_SIGNATURE' => GithubSignature::make('{"repository":{"full_name":"SyncronetDev\/seetv-laravel","html_url":"https:\/\/github.com\/SyncronetDev\/seetv-laravel"}}', '6aca922e786bfbd80e7a05dc04af2abeb3bee743')]
            )
            ->assertSuccessful();

        $this->assertDatabaseHas('deployments', [
            'source_provider_id' => $sourceProvider->getKey(),
            'status' => Deployment::STATUS_PENDING,
            'repository_url' => 'https://github.com/SyncronetDev/seetv-laravel',
            'branch' => 'master',
            'sha' => '1234-testing',
            'commit_message' => 'Initial Commit',
            'script' => 'scripts.github.deployment',
            'script_output' => null,
            'executed_at' => null
        ]);

        Bus::assertDispatched(ExecuteDeployment::class);
    }
}
