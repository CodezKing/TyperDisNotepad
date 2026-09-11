<?php

namespace App\Models;

use App\Models\creditsAccount;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class Account extends Model
{
    //
    protected $fillable = [
        'account_id',
        'email',
        'password',
        'created_at',
        'updated_at',
        'user_id',
    ];

    public function creditsAccount() {
        return $this->hasOne(creditsAccount::class, 'account_id', 'credit_id');
    }
    public function user() {
        return $this->hasOne(user::class, 'account_id','user_id');
    }

    public function document() {
        return $this->hasOne(Document::class,'account_id','document_id');
    }
}
