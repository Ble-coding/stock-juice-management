<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Stock::all();
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
     // Stocke un nouveau stock (approvisionnement)
     public function store(StoreStockRequest $request)
     {
         $validated = $request->validated();
 
         // Incrémentez la quantité disponible du produit approvisionné
         $product = Product::findOrFail($validated['product_id']);
         $product->stocks()->increment('quantity', $validated['quantity']);
 
         // Enregistrez l'approvisionnement
         $stock = Stock::create($validated);
 
         return response()->json($stock, 201);
     }
    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        return response()->json($stock);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockRequest $request, Stock $stock)
    {
        $validated = $request->validated();

        // Trouvez le produit lié à l'approvisionnement
        $product = $stock->product;

        // Annulez l'impact de l'approvisionnement initial sur le stock actuel
        $product->stocks()->decrement('quantity', $stock->quantity);

        // Mettez à jour l'approvisionnement avec les nouvelles informations validées
        $stock->update($validated);

        // Mettez à jour le stock après la mise à jour de l'approvisionnement
        $product->stocks()->increment('quantity', $validated['quantity']);

        return response()->json($stock);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return response()->json(['message' => 'Stock deleted successfully']);
    }
}
