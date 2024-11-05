<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'titre' => 'required',
            'slug' => 'required',
            'sousTitre' => 'sometimes',
            'img' => 'required',
            'banniere' => 'sometimes',
            'description' => 'required',
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

    // protected function failedValidation(Validator $validator): void
    // {
    //     throw new HttpResponseException(
    //         dd($validator->errors()->toArray(), 422)
    //     );
    // }
}
