<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParcelleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasAnyRole(['Manager', 'Administrateur']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_parcelle' => 'required|string|max:255',
            'localisation_parcelle' => 'required|string|max:255',
            'proprietaire_id' => 'required|exists:proprietaires,id',
        ];
    }
}
