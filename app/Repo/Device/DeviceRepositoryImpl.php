<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 24/03/2018
 * Time: 10:26 AM
 */

namespace App\Repository\Device;


use App\Device;
use App\Utils\Logging;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DeviceRepositoryImpl implements DeviceRepo
{

    use Logging;

    /**
     * @param $imei String The imei of device
     * @return mixed
     * find device by its imei
     */
    function findByIMEI($imei)
    {
        return Device::where('imei', $imei)->first();
    }


    //find device id

    function getPushRegistration($devID)
    {
        $device = $this->get($devID);

        return $device->fcmToken;
    }

    function get($id)
    {
        return Device::find($id);

    }

    function generateDevice(Device $device)
    {
        // TODO: Implement generateDevice() method.
    }

    function updateFcmToken($fcm_token)
    {
        $device = $_REQUEST['device'];
        $device->fcm_token = $fcm_token;
        if ($this->update($device)) {
            return true;
        }

        return false;
    }

    /**
     * @param Model $model
     * @param $attributes
     * @return bool
     */
    function update(Model $model, array $attributes): bool
    {
        try {
            $this->logDevice('Updating a device with ID ' . $model->id);
            $model->update();
        } catch (Exception $exception) {
            $this->logException($exception);

            return false;
        }

        return true;
    }

    /**
     * @param Model $model
     * @return boolean
     */
    function create(Model $model): bool
    {
        try {
            $this->logDevice('Creating a device with fingerprint ' . $model->imei);
            $model->save();
        } catch (Exception $exception) {
            $this->logException($exception);

            return false;
        }

        return true;
    }

    /**
     * @param Builder $queryBuilder
     * @return mixed
     */
    function read(Builder $queryBuilder)
    {
        return $queryBuilder->get();
    }

    /**
     * @param Model $model
     * @return bool
     * @throws Exception
     */
    function delete(Model $model): bool
    {
        return $model->delete();
    }
}
