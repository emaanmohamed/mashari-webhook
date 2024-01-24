<?php

namespace App\Services;

use App\Models\ApiLog;

class LogService
{
    public function logListOfCountries($request)
    {
        return ApiLog::create([
            'method' => $request->method(),
            'path' => $request->path(),
            'ip' => $request->ip(),
            'callbackUrl' => $request->callbackUrl,
        ]);
    }

}