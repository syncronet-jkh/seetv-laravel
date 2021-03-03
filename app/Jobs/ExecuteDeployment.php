<?php

namespace App\Jobs;

use App\Models\Deployment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;

class ExecuteDeployment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * A deployment may run for up to 10 minutes (600s).
     *
     * @var int
     */
    public int $timeout = 600;

    /**
     * @var Deployment
     */
    public Deployment $deployment;

    /**
     * Create a new job instance.
     *
     * @param Deployment $deployment
     * @return void
     */
    public function __construct(Deployment $deployment)
    {
        $this->deployment = $deployment;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Throwable
     */
    public function handle()
    {
        $this->deployment->execute();
    }

    public function middleware()
    {
        return [
            new WithoutOverlapping('deployments')
        ];
    }
}
