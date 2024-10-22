<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tag::withTrashed()->get();
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
    public function store(StoreTagRequest $request)
    {
        $tagsData = $request->input('tags');

        foreach ($tagsData as $tagData) {
            Tag::create([
                'name' => $tagData['name'],
            ]);
        }

        return response()->json(['message' => 'Tags crées avec succès'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return response()->json($tag);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request,Tag $tag)
    {
        try {
            $tag->update($request->validated());
            return response()->json($tag);
        } catch (\Exception $e) {
            \Log::error('Update Tag Error: ' . $e->getMessage());
            return response()->json(['error' => 'Échec de la mise à jour du tag.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json(['message' => 'Tag deleted successfully']);
    }

    public function restore($id)
    {
        $tag = Tag::withTrashed()->find($id); // Trouver la catégorie avec soft deletes
        if ($tag && $tag->trashed()) {
            $tag->restore(); // Restaurer la catégorie
            return response()->json(['message' => 'Tag restored successfully'], 200);
        }
        return response()->json(['message' => 'Tag not found or not deleted'], 404);
    }
}
