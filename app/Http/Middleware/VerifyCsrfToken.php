<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/success',
        '/cancel',
        '/fail',
        '/ipn',
        '/pay-via-ajax',
        '/login',
        '/success-fund',
        '/fail-fund',
        '/cancel-fund',
        '/success-flight-pay',
        '/fail-flight-pay',
        '/cancel-flight-pay',
    ];
}
