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
        // WARNING: This is just for demonstration purposes.
        // Excluding routes from CSRF protection can lead to security vulnerabilities:
        // 1. Cross-Site Request Forgery attacks
        // 2. Unauthorized state-changing requests
        // 3. Session hijacking risks
        'api/webhook'
    ];
}
