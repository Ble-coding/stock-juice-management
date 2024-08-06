<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Sale::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        // $sale = Sale::create($request->validated());

        // return response()->json($sale, 201);

        $validated = $request->validated();

        // Optionnel : Vous pouvez vérifier si le produit existe réellement
        $product = Product::findOrFail($validated['product_id']);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->stocks()->decrement('quantity', $validated['quantity']);

        // Créez la vente
        $sale = Sale::create($validated);

        return response()->json($sale, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return response()->json($sale);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        $validated = $request->validated();
    
        // Trouvez le produit lié à la vente
        $product = $sale->product;
    
        // Annulez l'impact de la vente initiale sur le stock actuel
        $product->stocks()->increment('quantity', $sale->quantity);
    
        // Mettez à jour la vente avec les nouvelles informations validées
        $sale->update($validated);
    
        // Mettez à jour le stock après la mise à jour de la vente
        $product->stocks()->decrement('quantity', $validated['quantity']);
    
        return response()->json($sale);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return response()->json(['message' => 'Sale deleted successfully']);
    }
}
