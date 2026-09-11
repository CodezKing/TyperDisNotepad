<?php

use App\Models\Account;
use App\Models\creditsAccount;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    
    // return 3rd user
    $user = App\Models\User::find(3);

    $document = App\Models\Document::find(2);

    $creditsAccount = App\Models\creditsAccount::find(2);

    $accounts = App\Models\Account::find(2);

    return compact('User', 'Document', 'creditsAccount', 'Account');
});
