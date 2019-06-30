<?php

namespace App\Http\Requests;

use App\Utils\Logging;

class RoomRequest extends BaseRequest
{
    use Logging;

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
            'name' => 'required|unique:rooms,name',
            'room_type_id' => 'required|exists:room_types,id',
        ];
    }

    public function filters()
    {
        return [
            'name' => 'trim|escape',
        ];
    }
}
