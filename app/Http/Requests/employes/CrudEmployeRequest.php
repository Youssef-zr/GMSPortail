<?php

namespace App\Http\Requests\employes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class CrudEmployeRequest extends FormRequest
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
            'matricule' => 'required|string|max:10|unique:employes,cin',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'cin' => 'required|max:12|unique:employes,cin',
            'cnss' => 'sometimes|nullable|min:9|max:9|unique:employes,cnss',
            'IDSite' => 'required',
            'IDClient' => 'required',
        ];

        $method = strtolower(request()->method());
        if ($method == "patch") {
            $rules['cin'] = "required|unique:employes,cin," . $this->employe->id;
            $rules['cnss'] = "sometimes|nullable|min:9|max:9|unique:employes,cnss," . $this->employe->id;
            $rules = Arr::except($rules, ['matricule']);
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'IDSite' => 'site',
            'IDClient' => 'nom du client',
        ];

        return $attributes;
    }
}
