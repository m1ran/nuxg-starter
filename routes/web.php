<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PageAController;
use App\Http\Middleware\ResolveUserByLink;

Route::get('/', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'submit'])->name('registration.submit');

Route::group(['prefix' => 'page-a', 'middleware' => ResolveUserByLink::class], function () {
    Route::get('/{link}', [PageAController::class, 'index'])->name('page.a.index');
    Route::get('/{link}/history', [PageAController::class, 'history'])->name('page.a.history');
    Route::post('/{link}/play', [PageAController::class, 'play'])->name('page.a.play');
    Route::post('/{link}/generate', [PageAController::class, 'generateLink'])->name('page.a.generate');
    Route::delete('/{link}/deactivate', [PageAController::class, 'deactivateLink'])->name('page.a.deactivate');
});
