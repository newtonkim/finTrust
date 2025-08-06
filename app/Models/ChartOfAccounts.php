<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChartOfAccounts extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Database\Factories\ChartOfAccountsFactory::new();
    }

       protected $fillable = [
        'gl_code',
        'name',
        'account_type',
        'parent_account_id',
        'description',
        'is_active',
    ];

    public function parentAccount()
    {
        return $this->belongsTo(ChartOfAccounts::class, 'parent_account_id');
    }


    public function childAccounts()
    {
        return $this->hasMany(ChartOfAccounts::class, 'parent_account_id');
    }

     public function generalLedgerEntries()
    {
        return $this->hasMany(GeneralLedgerEntry::class);
    }

    public function subLedgers()
    {
        return $this->hasMany(SubLedger::class);
    }

}
