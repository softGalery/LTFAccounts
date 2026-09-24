<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // This is assets section
    Route::get('/asset', [AssetController::class, 'index'])->name('asset.index');
    Route::get('/all-asset', [AssetController::class, 'allAsset'])->name('asset.all');
    Route::post('/asset-add', [AssetController::class, 'creatAsset'])->name('assetStore');
    Route::post('/asset-delete', [AssetController::class, 'deleteAsset'])->name('assetDelete');


});

require __DIR__.'/auth.php';
