<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDemandeCongeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type_conge_id' => 'required|exists:type_conges,id',
            'date_debut'    => 'required|date',
            'date_fin'      => 'required|date|after_or_equal:date_debut',
            'motif'         => 'required|string|max:1000',
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
            'type_conge_id.required' => 'Le type de congé est obligatoire.',
            'type_conge_id.exists'   => 'Le type de congé sélectionné est invalide.',
            'date_debut.required'    => 'La date de début est obligatoire.',
            'date_fin.required'      => 'La date de fin est obligatoire.',
            'date_fin.after_or_equal' => 'La date de fin doit être après ou égale à la date de début.',
            'motif.required'         => 'Le motif est obligatoire.',
            'motif.max'              => 'Le motif ne peut pas dépasser 1000 caractères.',
        ];
    }
}
