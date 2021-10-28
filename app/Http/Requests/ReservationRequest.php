<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
        $rules = [
            'room_id'          => 'required|integer|exists:rooms,id',
            'user_id'          => 'required|integer|exists:users,id',
            'person_number'    => 'required|integer',
            'paid'             => 'nullable|integer|min:1',
            'start_at'         => 'required|date|min:1',
            'end_at'           => 'required|date|after:start_at',
            'image'            => 'nullable|image',
        ];

        return $rules;
    }
}
