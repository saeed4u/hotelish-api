<?php

namespace App\Http\Requests;


use Waavi\Sanitizer\Laravel\FormRequest;

class BookingRequest extends FormRequest
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
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required_with_out:name,email|exists:users,id',
            'name' => 'required_unless:user_id,null',
            'email' => 'required_unless:user_id,null|email',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }
}
