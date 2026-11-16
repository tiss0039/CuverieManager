<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('Caviste') ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'volume' => 'required|numeric|min:0',
            'type' => 'required|string|max:255',
            'proprietaire_id' => 'required|exists:proprietaires,id',
            'cuve_id' => 'required|exists:cuves,id',
            // Parcelle facultative ; si elle est renseignée, elle doit
            // appartenir au propriétaire sélectionné.
            'parcelle_id' => [
                'nullable',
                Rule::exists('parcelles', 'id')->where('proprietaire_id', $this->input('proprietaire_id')),
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'parcelle_id.exists' => 'La parcelle sélectionnée n\'existe pas ou n\'appartient pas au propriétaire choisi.',
        ];
    }
}
