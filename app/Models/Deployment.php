<?php

namespace App\Models;

use App\Concerns\HasCachedConstants;
use App\Jobs\ExecuteDeployment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Process\Process;
use function view;

class Deployment extends Model
{
    const STATUS_PENDING = 'Pending';
    const STATUS_RUNNING = 'Running';
    const STATUS_SUCCESS = 'Success';
    const STATUS_FAILED = 'Failed';

    use HasFactory, HasCachedConstants;

    protected $guarded = [];

    public function sourceProvider()
    {
        return $this->belongsTo(SourceProvider::class);
    }

    public function queue()
    {
        ExecuteDeployment::dispatch($this);

        return $this;
    }

    /**
     * Run the deployment and record the results
     *
     * @throws \Throwable
     */
    public function execute(): void
    {
        $this->update([
            'status' => self::STATUS_RUNNING
        ]);

        $process = Process::fromShellCommandline(
            $this->renderScript()
        );

        $process->setTimeout(600);

        try {
            $process->run(fn($type, $stdout) => $this->script_output .= $stdout);
        } finally {
            $this->status = $process->isSuccessful() ? self::STATUS_SUCCESS : self::STATUS_FAILED;
            $this->executed_at = $this->freshTimestampString();
            $this->saveOrFail();
        }
    }

    /**
     * Render the script with the provided parameters
     *
     * @return string
     */
    public function renderScript(): string
    {
        return view($this->script, ['deployment' => $this])->render();
    }
}
