<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\creditsAccount;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $creditsAccount = creditsAccount::with('account')->paginate(10);
        return response()->json($creditsAccount);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'credit_id' => 'required|string|max:11',
            'amount' => 'nullable|float|max:no-limit',
            'meta_data' => 'nullable|json',
        ]);

        $creditsAccount = creditsAccount::create($validated);
        $creditsAccount->update($validated);

        return response()->json($creditsAccount);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $credit_id)
    {
        //
        $creditsAccount = creditsAccount::with('creditsAccount')->findOrFail($credit_id);
        return response()->json($creditsAccount);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {        
      //
        $validated = $request->validate([
            'credit_id' => 'required|string|max:11',
            'amount' => 'nullable|float|max:no-limit',
            'meta_data' => 'nullable|json',
        ]);

        $creditsAccount = creditsAccount::create($validated);
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

        return response()->json(['message' => 'creditsAccount deleted successfully'], 200);
    }
}
