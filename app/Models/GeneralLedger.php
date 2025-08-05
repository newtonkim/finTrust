<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralLedger extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'general_ledgers';

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_date',
        'reference_number',
        'description',
    ];
    
    /**
     * Get the individual debit and credit entries for this general ledger transaction.
     */
    public function entries(): HasMany
    {
        return $this->hasMany(GeneralLedgerEntry::class);
    }
}
