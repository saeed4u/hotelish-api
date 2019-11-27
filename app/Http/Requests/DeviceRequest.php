<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imei' => 'required',
            'app_version' => 'required',
            'os' => 'required',
            'os_version' => 'required',
        ];
    }

    public function filters()
    {
        return [
            'imei' => 'trim',
            'app_version' => 'trim',
            'os' => 'trim',
        ];
    }


}
