<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('login');

        if(!$request->expectsJson()){
            if($request->routeIs('admin.*')){
                session()->flash('fail', 'Você precisa estar logado para acessar esta página');
                return route('admin.login');
            }

            if($request->routeIs('seller.*')){
                session()->flash('fail', 'Você precisa estar logado para acessar esta página');
                return route('seller.login');
            }
        }
    }
}