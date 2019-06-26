<?php

namespace App\Http\Middleware;

use App\Pricing;
use App\Utils\ApiResponse;
use Closure;

class PricingMiddleware
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $pricing = Pricing::find($request->id);
        if (!$pricing) {
            return $this->notFound("Pricing with $request->id not found");
        }
        $request->pricing = $pricing;
        return $next($request);
    }
}
