<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::with('account')->paginate(10);
        return response()->json($documents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_id' => 'required|string|max:11',
            'document_name' => 'required|string|max:255',
        ]);

        $document = Document::create($validated);

        return response()->json($document);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $document = Document::with('account')->findOrFail($id);
        return response()->json($document);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $user_id)
    {
        $validated = $request->validate([
            'document_id' => 'required|string|max:11',
            'document_name' => 'required|string|max:255',
        ]);

        $document = Document::findOrFail($user_id);
        $document->update($validated);

        return response()->json($document);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $document = Document::findOrFail($id);
        $document->delete();

        return response()->json(['message' => 'Document deleted successfully'], 200);
    }
}
