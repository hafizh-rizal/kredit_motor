<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            if ($request->is('pelanggan/*') || $request->is('pengajuan_kredit/*') || $request->is('kredit/*') || $request->is('pengiriman/*') || $request->is('angsuran/*')) {
                return route('pelanggan.auth.login');
            }

            return route('login'); 
        }

        return null;
    }
}
