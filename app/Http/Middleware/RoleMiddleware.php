<?php

namespace App\Http\Middleware;

use App\Exceptions\CustomException;
use App\Traits\ApiResponser;
use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    use ApiResponser;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            throw new CustomException('Unauthenticated.');
        }

        if (auth()->user()->role !== $role) {
            throw new CustomException('Unable to perform action. Access denied.');
        }

        return $next($request);
    }
}
