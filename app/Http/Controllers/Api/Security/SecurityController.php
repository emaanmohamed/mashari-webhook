<?php

namespace App\Http\Controllers\Api\Security;

use App\Services\AuthService;
use Illuminate\Http\Request;

class SecurityController
{

    public function __construct(private AuthService $authService){}

    public function requestToken(Request $request)
    {
        return $this->authService->requestToken($request->input('client_id'),$request->input('client_secret'));

    }
}