<?php

namespace App\Http\Requests\clients;

use Illuminate\Foundation\Http\FormRequest;

class CrudClientRequest extends FormRequest
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
            'raison_sociale' => "required|unique:clients,raison_sociale",
            'phone' => "required|numeric|unique:clients,phone",
            'email' => "required|email|unique:clients,email",
            'photo' => "sometimes|nullable|image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100,max_width=200,max_height=200|max:120",
            'code_client_omag' => "required|numeric|unique:clients,code_client_omag",
            "sync" => "sometimes|nullable",
        ];

        $method = strtolower(request()->method());
        if ($method == "patch") {
            $rules['raison_sociale'] = "required|unique:clients,raison_sociale," . $this->client->id;
            $rules['phone'] = "required|numeric|unique:clients,phone," . $this->client->id;
            $rules['email'] = "required|email|unique:clients,email," . $this->client->id;
            $rules['code_client_omag'] = "required|numeric|unique:clients,code_client_omag," . $this->client->id;
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'phone' => "télephone",
            'email' => "adresse email",
            'code_client_omag' => "code client",
        ];

        return $attributes;
    }

}
