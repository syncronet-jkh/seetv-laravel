<?php

namespace App;

use function hash_hmac;

class GithubSignature
{
    public static function make(string $data, string $deploymentSecret): string
    {
        return 'sha1=' . hash_hmac(
                'sha1',
                $data,
                $deploymentSecret
            );
    }
}
