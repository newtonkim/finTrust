<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubLedgerTransaction extends Model
{
      use HasFactory;

      protected $fillable = [
        'sub_ledger_id',
        'transaction_date',
        'reference_number',
        'amount',
        'type', // e.g., 'invoice', 'payment'
        'description'
      ];


    /**
     * Get the sub-ledger that this transaction belongs to.
     */
    public function subLedger(): BelongsTo
    {
        return $this->belongsTo(SubLedger::class);
    }


}
