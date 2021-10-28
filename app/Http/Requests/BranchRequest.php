<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
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

                    foreach (config('translatable.locales') as $locale) {
                        $rules += [
                            $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('branch_translations', 'name')],
                            $locale . '.description' => ['required', 'string', 'min:3', 'max:1500', Rule::unique('branch_translations', 'description')],
                            $locale . '.address'     => ['required', 'string', 'min:3', 'max:250', Rule::unique('branch_translations', 'address')],
                        ];
                    }

                    $rules += [
                        'image'            => 'nullable|mimes:jpeg,jpg,png,gif|max:20000',
                    ];

                    return $rules;
                }
            case 'PATCH': {
                    foreach (config('translatable.locales') as $locale) {
                        $rules += [
                            $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('branch_translations', 'name')->ignore($this->branch, 'branch_id')],
                            $locale . '.description' => ['required', 'string', 'min:3', 'max:250', Rule::unique('branch_translations', 'description')->ignore($this->branch, 'branch_id')],
                            $locale . '.address'     => ['required', 'string', 'min:3', 'max:250', Rule::unique('branch_translations', 'address')->ignore($this->address, 'branch_id')],
                        ];
                    }

                    $rules += [
                        'image'            => 'nullable|mimes:jpeg,jpg,png,gif|max:20000',
                    ];

                    return $rules;
                }
            default:
                break;
        }
    }
}
