<?php

namespace Abdiwaahid\LanguageSwitcher\Http\Middleware;

use Abdiwaahid\LanguageSwitcher\Facades\LanguageSwitcher;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguageSwitcherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = LanguageSwitcher::get();
        LanguageSwitcher::switch($locale);

        return $next($request);
    }
}
