<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['sometimes', 'required'],
            'slug' => ['sometimes', 'required'],
            'sousTitre' => 'sometimes',
            'img' => ['sometimes', 'required'],
            'banniere' => 'sometimes',
            'description' => ['sometimes', 'required'],
            'isNav' => 'sometimes',
            'doc' => 'sometimes',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => "Le Titre obligatoire",
            'description.required' => "La description obligatoire",
            'img.required' => "L'image est obligatoire",
        ];
    }
}
