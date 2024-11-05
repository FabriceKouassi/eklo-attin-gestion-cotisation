<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'nom' => 'required',
            'prenoms' => 'required',
            'email' => ['required','unique:users'],
            'password' => ['required', 'min:8', 'max:15'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Veuiller renseigner votre nom',
            'prenoms.required' => 'Veuiller renseigner votre prenoms',
            'email.required' => 'Veuiller renseigner votre email',
            'email.unique' => 'Cet email est déjà utilisé',
            'password.required' => 'Veuiller renseigner votre mot de passe',
            'password.min' => 'Le mot de passe dois être en dessous de 8 caractères',
            'password.max' => 'Le mot de passe dois exédé les 8 caractères',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            dd($validator->errors()->toArray(), 422)
        );
    }
}
