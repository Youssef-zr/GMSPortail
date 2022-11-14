<?php

namespace App\Http\Requests\tickets;

use Illuminate\Foundation\Http\FormRequest;

class CrudTicketRequest extends FormRequest
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
            "objet_ticket"=>'required',
            "IDService"=>'required',
            "IDPriorite"=>'required',
            "message"=>'required',
        ];

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'objet_ticket' => 'titre de ticket',
            'IDService' => 'nom du service',
            'IDPriorite' => 'Priorité',
        ];

        return $attributes;
    }
}
