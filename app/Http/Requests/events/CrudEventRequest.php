<?php

namespace App\Http\Requests\events;

use Illuminate\Foundation\Http\FormRequest;

class CrudEventRequest extends FormRequest
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
            'title' => 'required|max:100',
            'start_date' => 'required|date',
            'end_date' => 'sometimes|nullable|date|after:start_date',
            "IDClient" => "required",
        ];

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'IDClient' => 'nom du client',
            'start_date' => 'date de depart',
            'end_date' => 'date fin',
        ];

        return $attributes;
    }
}
