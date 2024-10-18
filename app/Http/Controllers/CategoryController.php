<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retourner toutes les catégories, y compris celles supprimées avec soft delete
        return Category::withTrashed()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $categoriesData = $request->input('categories');

        foreach ($categoriesData as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'description' => $categoryData['description'] ?? null, // Valeur par défaut si non fournie
            ]);
        }

        return response()->json(['message' => 'Catégories créées avec succès'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateCategoryRequest $request, Category $category)
    // {
    //     $category->update($request->validated());

    //     return response()->json($category);
    // }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());
            return response()->json($category);
        } catch (\Exception $e) {
            \Log::error('Update Category Error: ' . $e->getMessage());
            return response()->json(['error' => 'Échec de la mise à jour de la catégorie.'], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }

    // Méthode pour restaurer une catégorie supprimée
    public function restore($id)
    {
        $category = Category::withTrashed()->find($id); // Trouver la catégorie avec soft deletes
        if ($category && $category->trashed()) {
            $category->restore(); // Restaurer la catégorie
            return response()->json(['message' => 'Category restored successfully'], 200);
        }
        return response()->json(['message' => 'Category not found or not deleted'], 404);
    }
}
