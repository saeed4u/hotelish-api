<?php

namespace App\Http\Middleware;

use App\Room;
use App\Utils\ApiResponse;
use Closure;

class RoomMiddleware
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
        $room = Room::find($request->id);
        if (!$room) {
            return $this->notFound("Room with $request->id not found");
        }
        $_REQUEST['room'] = $room;
        return $next($request);
    }
}
