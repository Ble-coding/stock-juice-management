<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        // dd('rules');
        return [

            'title' => 'required|string|max:255|unique:products', // Le titre est obligatoire et unique
            'sku' => 'required|string|max:255|unique:products', // Le SKU est obligatoire et unique
            'regular_price' => 'sometimes|required|numeric', // Champ facultatif mais requis s'il est présent, doit être numérique
            'sale_price' => 'sometimes|nullable|numeric', // Champ facultatif, peut être nul
            'stock' => 'sometimes|required|integer|min:0', // Vérifie que le stock est un entier et non négatif
            'category' => 'required|array', // Les catégories doivent être un tableau
            'tag' => 'required|array', // Les tags doivent être un tableau
            'category.*' => 'exists:categories,id',
            'tag.*' => 'exists:tags,id',
            'images' => 'required|array',
            //  'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre du produit est obligatoire.',
            'title.unique' => 'Ce titre existe déjà.',
            'sku.required' => 'Le SKU est obligatoire.',
            'sku.unique' => 'Ce SKU existe déjà.',
            'regular_price.required' => 'Le prix régulier est obligatoire.',
            'sale_price.numeric' => 'Le prix en promotion doit être un nombre.',
            'stock.integer' => 'Le stock doit être un entier.',
            'category.required' => 'Une catégorie doit être sélectionnée.',
            'tag.required' => 'Un tag doit être sélectionné.',
            'images.*.image' => 'Chaque fichier doit être une image.',
            'images.*.mimes' => 'Les formats acceptés pour les images sont jpeg, png, jpg, gif.',
            'images.*.max' => 'Chaque image ne doit pas dépasser 2 Mo.',
        ];
    }
}
