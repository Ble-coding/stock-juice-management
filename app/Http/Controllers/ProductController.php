<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Affiche tous les produits
        // return Product::all();
        // Fetch all products with related categories and tags

            $products = Product::with(['categories', 'tags'])->withTrashed()->get();

              // Assurez-vous de renvoyer l'URL complète des images si elles sont stockées dans le système de fichiers public
                foreach ($products as $product) {
                    $product->image = url('storage/' . $product->image);
                }


                return response()->json($products);

    }

    public function getCategoriesAndTags() {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $tags = Tag::select('id', 'name')->orderBy('name')->get();

        return response()->json([
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function checkSKUUnique(Request $request)
    {
        $sku = $request->query('sku');
        $isUnique = !Product::where('sku', $sku)->exists();
        return response()->json(['isUnique' => $isUnique]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request) {
        try {
            \Log::info('Requête reçue', $request->all()); // Log toutes les données reçues

            $product = Product::create($request->except('images'));
            $product->categories()->sync($request->category);
            $product->tags()->sync($request->tag);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    \Log::info('Image reçue', ['name' => $image->getClientOriginalName()]);
                    $path = $image->store('products', 'public');
                    $product->images()->create(['path' => $path]);
                }
            } else {
                \Log::info('Aucune image reçue');
            }

            return response()->json($product, 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
         // Met à jour un produit spécifique

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->update($request->validated());


        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
         // Supprime un produit spécifique

         if (!$product) {
             return response()->json(['message' => 'Product not found'], 404);
         }

         $product->delete();

         return response()->json(['message' => 'Product deleted successfully']);
    }



    public function restore($id)
    {
        $product = Product::withTrashed()->find($id); // Trouver le client avec soft deletes
        if ($product && $product->trashed()) {
            $product->restore(); // Restaurer le client
            return response()->json(['message' => 'Product restored successfully'], 200);
        }
        return response()->json(['message' => 'Product not found or not deleted'], 404);
    }

    public function toggleStarred($id)
    {
        $product = Product::findOrFail($id);
        $product->is_starred = !$product->is_starred; // Inverse le statut
        $product->save();

        return response()->json(['success' => true, 'is_starred' => $product->is_starred]);
    }



}
