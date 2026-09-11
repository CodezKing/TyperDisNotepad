<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\creditsAccount;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $creditsAccount = creditsAccount::with('creditsAccount')->paginate(10);
        return response()->json($creditsAccount);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'credit_id' => 'required|string|max:11',
            'amount' => 'required|string|max:255',
        ]);

        $creditsAccount = creditsAccount::create($validated);

        return response()->json($creditsAccount);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $creditsAccount = creditsAccount::with('creditsAccount')->findOrFail($id);
        return response()->json($creditsAccount);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $credit_id)
    {
        $validated = $request->validate([
            'credit_id' => 'required|string|max:11',
            'amount' => 'required|float|max:255',
        ]);

        $creditsAccount = creditsAccount::findOrFail($credit_id);
        $creditsAccount->update($validated);

        return response()->json($creditsAccount);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $credit_id)
    {
        //
        $creditsAccount = creditsAccount::findOrFail($credit_id);
        $creditsAccount->delete();

        return response()->json(['message' => 'credits account deleted successfully'], 200);
    }
}
