<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $fillable = [
        'document_id',
        'document_Name',
        'created_at',
        'updated_at',
        'user_id',
        'account_id'
    ];

    protected function User() {
        return $this->hasMany(User::class,'user_id','document_id');
    }
}
