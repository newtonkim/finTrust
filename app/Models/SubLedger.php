<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'chart_of_account_id',
    ];

    /**
     * Get the controlling Chart of Account for this sub-ledger.
     */
    public function chartOfAccount(): BelongsTo
    {
        return $this->belongsTo(chartOfAccounts::class);
    }


    /**
     * Get the detailed transactions for this sub-ledger.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(SubLedgerTransaction::class);
    }



}
