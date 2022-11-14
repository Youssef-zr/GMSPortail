<?php

namespace App\Http\Requests\clients\users;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class CrudClientUsersRequest extends FormRequest
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
            'name' => "required",
            'email' => "required|unique:users,email",
            "password" => "required",
            "phone" => "required|numeric|digits:10|unique:users,phone",
            "IDClient" => "required",
        ];

        $method = strtolower(request()->method());
        if ($method == "patch") {
            $rules["email"] = "required|unique:users,email," . $this->user;
            $rules["phone"] = "required|unique:users,phone," . $this->user;
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'name' => "Nom",
            'email' => "E-mail",
            "password" => "Mot de passe",
            "phone" => "Téléphone",
            "IDClient" => "Nom du client",
        ];

        return $attributes;
    }
}
