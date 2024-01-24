<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AuthService
{

    function requestToken($client_id = '', $client_secret = '')
    {
        $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'scope'         => '',
        ]);
        return response()->json(json_decode($response->body()), $response->status());
    }
}