<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * @license MIT
 * @link  https://github.com/cretueusebiu/laravel-nuxt/blob/master/app/Http/Middleware/SetLocale.php
 *
 */
class SetLocalisation
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($locale = $request->header('X-Locale')) {
            app()->setLocale($locale);
        }
        return $next($request);
    }
}
