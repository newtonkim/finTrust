<?php

namespace App\Models;

use App\Models\GeneralLedger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeneralLedgerEntry extends Model
{
    use HasFactory;

     protected $fillable = [
        'general_ledger_id',
        'chart_of_account_id',
        'debit',
        'credit',
    ];

    /**
     * Get the general ledger transaction that owns the entry.
     */
    public function generalLedger(): BelongsTo
    {
        return $this->belongsTo(GeneralLedger::class);
    }

    /**
     * Get the chart of account that this entry is posted to.
     */
    public function chartOfAccount(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccounts::class);
    }

    


}
