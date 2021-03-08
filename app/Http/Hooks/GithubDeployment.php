<?php

namespace App\Http\Hooks;

use App\GithubSignature;
use App\Models\Deployment;
use App\Models\SourceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function abort_unless;
use function data_get;
use function filled;

class GithubDeployment
{
    public function __invoke(Request $request, string $branch)
    {
        $sourceProvider = SourceProvider::Github();

        if (filled($sourceProvider->deployment_secret)) {
            abort_unless(
                hash_equals(
                    GithubSignature::make($request->getContent(), $sourceProvider->deployment_secret),
                    (string) $request->header('x-hub-signature')
                ),
                401,
                'Invalid GitHub signature.'
            );
        }

        $validated = $request->validate([
           'repository' => ['required', 'array'],
           'repository.full_name' => ['required_with:repository', 'string'],
           'repository.html_url' => ['required_with:repository', 'string', 'url'],
        ]);

        $latestCommitSha = Http::get("https://api.github.com/repos/{$validated['repository']['full_name']}/git/refs/heads/{$branch}")->json('object.sha');
        $latestCommit = Http::get("https://api.github.com/repos/syncronet-jkh/seetv-laravel/git/commits/{$latestCommitSha}")->json();

        /** @var Deployment $deployment */
        $deployment = $sourceProvider->deployments()->create([
            'status' => Deployment::STATUS_PENDING,
            'branch' => $branch,
            'repository_url' => $validated['repository']['html_url'],
            'sha' => $latestCommitSha,
            'commit_message' => data_get($latestCommit, 'message', ''),
            'script' => 'scripts.github.deployment',
        ]);

        $deployment->queue();
    }
}
