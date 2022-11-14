<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
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
            'name' => "required|string",
            'email' => "required|email",
            'phone' => "required|digits:10",
            'subject' => "required|string|max:250",
            'msg' => "required|string|max:1000",
        ];

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'name' => "Nom",
            'email' => "Email",
            'phone' => "Téléphone",
            'subject' => "sujet",
            'msg' => "message",
        ];

        return $attributes;
    }
}
