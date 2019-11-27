<?php

namespace App\Http\Middleware;

use App\Repository\Device\DeviceRepo;
use App\Utils\ApiResponse;
use App\Utils\Functions;
use App\Utils\Logging;
use Closure;
use Illuminate\Http\Request;

class DeviceMiddleware
{
    use Logging, ApiResponse;

    protected $deviceRepo;

    /**
     * DeviceMiddleware constructor.
     * @param $deviceRepo
     */
    public function __construct(DeviceRepo $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $deviceId = $request->header('device-id');
        $this->logDevice("Device ID = $deviceId");
        if ($deviceId) {
            $device = $this->deviceRepo->get($deviceId);
            if (!is_null($device) && $device->is_active) {
                $_REQUEST['device'] = $device;
                return $next($request);
            }
        }

        return $this->badRequest('Device ID is not valid');
    }
}
