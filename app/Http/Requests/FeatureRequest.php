<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FeatureRequest extends FormRequest
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
                            $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('feature_translations', 'name')],
                            $locale . '.description' => ['required', 'string', 'min:3', 'max:1500', Rule::unique('feature_translations', 'description')],
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
                            $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('feature_translations', 'name')->ignore($this->feature, 'feature_id')],
                            $locale . '.description' => ['required', 'string', 'min:3', 'max:1500', Rule::unique('feature_translations', 'description')->ignore($this->feature, 'feature_id')],
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
