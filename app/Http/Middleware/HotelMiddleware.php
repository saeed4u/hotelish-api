<?php

namespace App\Http\Middleware;

use App\Hotel;
use App\Room;
use App\Utils\ApiResponse;
use Closure;

class HotelMiddleware
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
        $hotel = Hotel::find($request->id);
        if (!$hotel) {
            return $this->notFound("Hotel with $request->id not found");
        }
        $_REQUEST['hotel'] = $hotel;
        return $next($request);
    }
}
