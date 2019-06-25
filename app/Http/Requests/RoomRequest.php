<?php

namespace App\Http\Requests;

class RoomRequest extends BaseRequest
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
            'name' => 'required',
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
