<?php

namespace App\Http\Requests\sites;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CrudSiteRequest extends FormRequest
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
        return [
            "libelle" => ["required", "string", Rule::unique('sites', "libelle")],
            "IDClient" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "IDClient" => "nom du client",
        ];
    }
}
