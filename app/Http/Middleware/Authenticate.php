<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

use Closure;
use Illuminate\Support\Arr;

class Authenticate extends Middleware
{
    // protected $guards;
    
    // public function handle($request, Closure $next, ...$guards)
    // {
    //     $this->guards = $guards;
    //     return parent::handle($request, $next, ...$guards);
    // }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     if (! $request->expectsJson()) {
    //         if (Arr::last($this->guards) === 'admin') {
    //             return route('admin.login');
    //         }

    //         return route('login');
    //     }
    // }
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}
