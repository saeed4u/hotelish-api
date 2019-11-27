<?php


namespace App\Service;


use App\Device;
use App\Http\Requests\DeviceRequest;
use App\Http\Requests\UpdateFCMRequest;
use App\Http\Resources\DeviceResource;
use App\Repository\Device\DeviceRepo;
use App\Utils\ApiResponse;
use App\Utils\Logging;
use Exception;

class DeviceService
{
    use ApiResponse, Logging;
    /**
     * @var DeviceRepo $deviceRepo
     */
    private $deviceRepo;

    /**
     * DeviceService constructor.
     * @param DeviceRepo $deviceRepo
     */
    public function __construct(DeviceRepo $deviceRepo)
    {
        $this->deviceRepo = $deviceRepo;
    }

    public function registerDevice(DeviceRequest $request)
    {
        try {
            $repo = $this->deviceRepo;
            $imei = $request->imei;
            /**
             * @var Device $device
             */
            $device = $repo->findByIMEI($imei);
            if ($device) {
                if (!is_null($request->fcm_token) && $request->fcm_token !== $device->fcm_token) {
                    $device->fcm_token = $request->fcm_token;
                    $device->save();
                }
                return $this->success('success', ['device' => new DeviceResource($device)]);
            }
            $fcm_token = $request->fcm_token;
            $app_version = $request->app_version;
            $os = $request->os;
            $os_version = $request->os_version;

            $device = new Device();
            $device->fcm_token = $fcm_token;
            $device->imei = $imei;
            $device->app_version = $app_version;
            $device->os_version = $os_version;
            $device->os = $os;
            if ($repo->create($device)) {
                return $this->success('success', ['device' => new DeviceResource($device)]);
            }
        }catch (Exception $exception){
            $this->logException($exception);
        }

        return $this->badGateway();
    }


    public function updateDeviceFcmToken(UpdateFCMRequest $request)
    {

        $device = $_REQUEST['device'];
        $device->fcm_token = $request->fcm_token;
        if ($device->save()) {
            return $this->success();
        }

        return $this->badGateway();
    }

}
