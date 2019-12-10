<?php

namespace App\Http\Middleware;

use App\Utils\ApiResponse;
use Closure;

class UserIsCustomerMiddleware
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user('api');
        if (strtolower($user->type) === 'customer') {
            return $next($request);
        }
        return $this->forbidden('You are not authorised to make this request');
    }
}
