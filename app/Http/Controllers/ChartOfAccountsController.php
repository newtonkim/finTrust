<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ChartOfAccounts;

class ChartOfAccountsController extends Controller
{
     public function index()
    {
        $accounts = ChartOfAccounts::with('parentAccount')->paginate(20);

        // Fetch all accounts (or just top-level ones) for the parent dropdown
        // Selecting only necessary fields for efficiency
        $allAccountsForDropdown = ChartOfAccounts::select('id', 'gl_code', 'name')->get();

        return Inertia::render('ChartOfAccounts/Index', [
            'accounts' => $accounts,
            'allAccounts' => $allAccountsForDropdown, // New prop for the parent dropdown
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'gl_code' => 'required|unique:chart_of_accounts,gl_code',
            'name' => 'required',
            'account_type' => 'required|in:Asset,Liability,Equity,Revenue,Expense',
            'parent_account_id' => 'nullable|exists:chart_of_accounts,id',
        ]);

        ChartOfAccounts::create($request->all());


        return redirect()->route('chart-of-accounts.index')
                         ->with('success', 'Account created successfully.');
    }


    public function update(Request $request, ChartOfAccounts $chartOfAccount)
    {
        $request->validate([
            'gl_code' => 'required|unique:chart_of_accounts,gl_code,' . $chartOfAccount->id,
            'name' => 'required',
            'account_type' => 'required|in:Asset,Liability,Equity,Revenue,Expense',
            'parent_account_id' => 'nullable|exists:chart_of_accounts,id',
        ]);

         $chartOfAccount->update($request->all());

        return redirect()->route('chart-of-accounts.index')
                         ->with('success', 'Account updated successfully.');
    }

    public function destroy(ChartOfAccounts $chartOfAccount)
    {
        $chartOfAccount->delete();

        return redirect()->route('chart-of-accounts.index')
                         ->with('success', 'Account deleted successfully.');
    }


}
