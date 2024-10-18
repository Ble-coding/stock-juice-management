<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categories.*.name' => 'required|string|max:255|unique:categories,name', // Nom unique et obligatoire
            'categories.*.description' => 'nullable|string', // Description optionnelle
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'name.required' => 'Le nom de la catégorie est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'name.unique' => 'Ce nom de catégorie existe déjà.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ];
    }
}
