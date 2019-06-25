<?php

namespace App\Http\Middleware;

use App\Utils\ApiResponse;
use Closure;

class UserIsAdminMiddleware
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if ($user->user_type !== 'admin'){
            return $this->unauthorised('You are not authorized to make this request');
        }
        return $next($request);
    }
}
