<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Ajoutez cette ligne

class UpdateProductRequest extends FormRequest
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
        $productId = $this->route('product')->id; // Récupération de l'ID du produit

        return [
            // 'user_id' => 'required|exists:users,id', // Assurez-vous que user_id existe dans la table users
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')->ignore($productId), // Vérifie l'unicité du titre
            ],
            'regular_price' => 'sometimes|required|numeric', // Champ facultatif mais requis s'il est présent
            'sale_price' => 'sometimes|nullable|numeric', // Champ facultatif
            'stock' => 'sometimes|required|integer|min:0', // Vérifie que le stock est un entier et non négatif
            'sku' => [
                'sometimes',
                'required',
                'string',
                Rule::unique('products')->ignore($productId), // Vérifie l'unicité du SKU
            ],
            'image' => 'nullable|url', // Champ d'image en tant qu'URL, peut être facultatif
            'status' => 'sometimes|required|boolean', // Vérifie que le statut est un booléen
            'is_starred' => 'sometimes|required|boolean', // Vérifie que is_starred est un booléen
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
