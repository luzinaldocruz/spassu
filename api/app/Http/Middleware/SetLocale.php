<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $header = $request->header('Accept-Language', 'en');

        $locale = strtolower(trim(explode(',', $header)[0]));

        if (str_starts_with($locale, 'pt')) {
            App::setLocale('pt-br');
        } else {
            App::setLocale('en');
        }

        return $next($request);
    }
}
