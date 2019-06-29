<?php

namespace App\Http\Middleware;

use App\Booking;
use App\Utils\ApiResponse;
use Closure;

class BookingMiddleware
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
        $booking = Booking::find($request->id);
        if (!$booking) {
            return $this->notFound("Booking with $request->id not found");
        }
        $_REQUEST['booking'] = $booking;
        return $next($request);
    }
}
