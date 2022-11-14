<?php

namespace App\Http\Requests\documents;

use Illuminate\Foundation\Http\FormRequest;

class CrudDocumentsRequest extends FormRequest
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
            'IDClient' => "required",
            'IDType' => "required",
            'libelle' => "required",
            'nom_fichier' => "required|max:5240|mimes:pdf,xls,xlsx,xlm,xla,xlc,xlt,xlw,doc,docx",
        ];

        $method = strtolower(request()->method());
        if ($method == "patch") {
            $rules['nom_fichier'] = "sometimes|nullable|max:5240|mimes:pdf,xls,xlsx,xlm,xla,xlc,xlt,xlw,doc,docx";
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'IDClient' => 'nom du client',
            'IDType' => 'type document',
        ];

        return $attributes;
    }
}
