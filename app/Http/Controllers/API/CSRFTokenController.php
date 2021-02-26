<?php


namespace App\Http\Controllers\API;


use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Cookie\CookieValuePrefix;
use Illuminate\Http\Request;

class CSRFTokenController
{
    public function index(Request $request, Encrypter $encrypter)
    {
        $token = $request->session()->token();

        $value = CookieValuePrefix::create('XSRF-TOKEN', $encrypter->getKey()).$token;

        return $encrypter->encrypt($value, VerifyCsrfToken::serialized());
    }
}
