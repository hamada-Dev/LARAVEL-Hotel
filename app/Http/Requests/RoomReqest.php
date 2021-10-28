<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomReqest extends FormRequest
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
        $rules = array();

        switch ($this->method()) {
            case 'POST': {

                    $rules = [
                        'image'            => 'nullable|mimes:jpeg,jpg,png,gif|max:20000',
                        'type_id'          => 'required|integer|exists:types,id',
                        'branch_id'        => 'required|integer|exists:branches,id',
                    ];

                    return $rules;
                }
            case 'PATCH': {

                    $rules = [
                        'image'            => 'nullable|mimes:jpeg,jpg,png,gif|max:20000',
                        'branch_id'        => 'required|integer|exists:branches,id',
                    ];

                    return $rules;
                }
            default:
                break;
        }
    }
}
