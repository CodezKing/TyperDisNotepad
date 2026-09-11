<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class creditsAccount extends Model
{
    //
    protected $fillable = [
        'credit_id',
        'amount',
        'account_id',
    ];

    public function Account() {
        return $this->hasOne(Account::class, 'credit_id', 'account_id');
    }
}
