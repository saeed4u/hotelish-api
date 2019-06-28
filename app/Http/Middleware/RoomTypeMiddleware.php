<?php

namespace App\Http\Middleware;

use App\RoomType;
use App\Utils\ApiResponse;
use App\Utils\Logging;
use Closure;

class RoomTypeMiddleware
{
    use ApiResponse, Logging;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roomType = RoomType::find($request->id);

        if (!$roomType) {
            return $this->notFound("RoomType with $request->id not found");
        }
        $_REQUEST['room-type'] = $roomType;
        return $next($request);
    }
}
