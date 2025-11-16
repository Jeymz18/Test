<?php

return [
    'aliases' => [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // ✅ Add admin alias
        'admin' => \App\Http\Middleware\CheckIsAdmin::class,
    ],
];
