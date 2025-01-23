<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Middleware\EnsureTokenIsValid;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'throttle:api', EnsureTokenIsValid::class])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware(['throttle:api'])->group(function () {
    Route::prefix('lead')->group(function () {
        Route::get('all', [LeadController::class, 'getAllLeads']);
        Route::get('get', [LeadController::class, 'getLead']);
        Route::post('store', [LeadController::class, 'storeLead']);
        Route::put('update', [LeadController::class, 'updateLead']);
        Route::delete('destroy', [LeadController::class, 'destroyLead']);
    });
});
