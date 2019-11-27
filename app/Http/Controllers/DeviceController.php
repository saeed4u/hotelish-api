<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceRequest;
use App\Http\Requests\UpdateFCMRequest;
use App\Service\DeviceService;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * @var DeviceService $deviceService
     */
    private $deviceService;

    /**
     * DeviceController constructor.
     * @param DeviceService $deviceService
     */
    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function registerDevice(DeviceRequest $request){
        $request->validated();
        return $this->deviceService->registerDevice($request);
    }

    public function updateFcmToken(UpdateFCMRequest $request){
        return $this->deviceService->updateDeviceFcmToken($request);
    }


}
