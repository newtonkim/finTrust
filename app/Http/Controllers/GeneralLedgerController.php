<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\GeneralLedger;


class GeneralLedgerController extends Controller
{

    public function index()
    {
        // Fetch all general ledger transactions.
        // We eager-load the 'entries' relationship to avoid N+1 query problems.
        // Within 'entries', we also eager-load the 'chartOfAccount' to get the account name/code.
        $transactions = GeneralLedger::with(['entries.chartOfAccount'])
                                     ->orderByDesc('transaction_date')
                                     ->paginate(15);

        // Prepare the data to be sent to the Inertia front-end.
       return Inertia::render('GeneralLedger/Index', [
            'transactions' => $transactions,
        ]);
    }
    
}
