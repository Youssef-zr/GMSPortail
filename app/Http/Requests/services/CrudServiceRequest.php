<?php

namespace App\Http\Requests\services;

use Illuminate\Foundation\Http\FormRequest;

class CrudServiceRequest extends FormRequest
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
            'libelle' => 'required|string|unique:services,libelle',
            'email' => 'required|email|unique:services,email',
        ];

        $method = strtolower(request()->method());
        if ($method == "patch") {
            $rules['email'] = 'required|email|unique:services,email,'.$this->service->id;
            $rules['libelle'] = 'required|email|unique:services,libelle,'.$this->service->id;
        }

        return $rules;
    }
}
