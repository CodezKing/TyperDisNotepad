<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CreditsAccountController;
use App\Http\Controllers\UserController;

Route::apiResource('account', AccountController::class);
Route::apiResource('document', DocumentController::class);
Route::apiResource('creditsAccount', CreditsAccountController::class);
Route::apiResource('user', UserController::class)->only(['index', 'show']);

?>