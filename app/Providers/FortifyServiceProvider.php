<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // 🔐 LOGIN PERSONALIZADO POR USUARIO
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('usuario_login', $request->usuario_login)->first();

            if ($user && Hash::check($request->password, $user->password_hash)) {
                return $user;
            }

            return null;
        });

        RateLimiter::for('login', function (Request $request) {
            $login = (string) $request->usuario_login;

            return Limit::perMinute(5)->by($login.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
