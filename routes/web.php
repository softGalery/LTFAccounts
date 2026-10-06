<?php

use App\Http\Controllers\AccountsPayableController;
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
    Route::post('/asset-update', [AssetController::class, 'updateAsset'])->name('assetUpdate');
    Route::post('/asset-by-id', [AssetController::class, 'getAssetById'])->name('assetById');

    // This is accounts payable section
    Route::get('/accounts-payable', [AccountsPayableController::class, 'index'])->name('accountsPayable.index');
    Route::get('/accounts-payable-list',[AccountsPayableController::class, 'listAccountsPayable'])->name('accountsPayable.getList');
    Route::Post('/create-acconts-payable',[AccountsPayableController::class, 'createAccountsPayable'])->name('accountsPayable.create');
    Route::post('/asset-get-by-id', [AssetController::class, 'getAssetById'])->name('assetGetById');

});

require __DIR__.'/auth.php';
