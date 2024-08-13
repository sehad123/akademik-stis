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
        //
        'forgot-password',
        'api/*',
        'login',  // or your specific route path
        'verify-face',
        'logout',
        'csrf-token', // tambahkan route csrf-token di sini
        'student/*', // tambahkan route csrf-token di sini
        'dosen/*', // tambahkan route csrf-token di sini




    ];
}
