<?php

namespace App\Http\Middleware;

use App\Utils\ApiResponse;
use App\Utils\Logging;
use Closure;

class RequestResponseMiddleware
{
    use Logging;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->req_id = rand(pow(10, 11), pow(10, 12) - 1);
        $this->logRequest($request);

        return $next($request);
    }

    public function terminate($request, $response)
    {
        $this->logResponse($request, $response);
    }

}
