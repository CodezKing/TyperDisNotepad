<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account = Account::with('account')->paginate(10);
        return response()->json($account);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'required|string|max:11',
            'email' => 'required|string|max:50',
            'password' => 'required|string|max:50',
        ]);

        $account = Account::create($validated);

        return response()->json($account);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $account_id)
    {
        $account = Account::with('account')->findOrFail($account_id);
        return response()->json($account);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $user_id)
    {
        $validated = $request->validate([
            'account_id' => 'required|string|max:11',
            'account_name' => 'required|string|max:255',
        ]);

        $account = Account::findOrFail($user_id);
        $account->update($validated);

        return response()->json($account);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $account_id)
    {
        //
        $account = Account::findOrFail($account_id);
        $account->delete();

        return response()->json(['message' => 'Account deleted successfully'], 200);
    }
}
