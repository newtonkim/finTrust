<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\SubLedger;
use Illuminate\Http\Request;
use App\Models\ChartOfAccounts;
use Illuminate\Http\RedirectResponse;

class SubLedgersController extends Controller
{
    /**
     * Display a paginated list of sub-ledgers.
     */

    public function index(): Response
    {
        // Eager load the controlling chart of accounts for each sub-ledger
        $subLedgers = SubLedger::with('chartOfAccount')->paginate(10);
        
        $chartOfAccounts = ChartOfAccounts::select('id', 'name', 'gl_code')->get();

        return Inertia::render('SubLedgers/Index', [
            'subLedgers' => $subLedgers,
            'chartOfAccounts' => $chartOfAccounts,
        ]);
    }


    /**
     * Store a new sub-ledger.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sub_ledgers,name',
            'description' => 'nullable|string',
            'chart_of_account_id' => 'required|exists:chart_of_accounts,id',
        ]);

        SubLedger::create($request->all());

        return redirect()->route('sub-ledgers.index')
                         ->with('success', 'Sub-ledger created successfully.');
    }


    /**
     * Update an existing sub-ledger.
     */
    public function update(Request $request, SubLedger $subLedger): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sub_ledgers,name,' . $subLedger->id,
            'description' => 'nullable|string',
            'chart_of_account_id' => 'required|exists:chart_of_accounts,id',
        ]);

        $subLedger->update($request->all());

        return redirect()->route('sub-ledgers.index')
                         ->with('success', 'Sub-ledger updated successfully.');
    }

    /**
     * Remove a sub-ledger.
     */
    public function destroy(SubLedger $subLedger): RedirectResponse
    {
        $subLedger->delete();

        return redirect()->route('sub-ledgers.index')
                         ->with('success', 'Sub-ledger deleted successfully.');
    }
}
