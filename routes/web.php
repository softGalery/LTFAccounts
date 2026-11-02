<?php

use App\Http\Controllers\AccountsPayableController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LiabilityController;
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
    Route::POST('/delete-accounts-payable', [AccountsPayableController::class, 'deleteAccountsPayable'])->name('accountsPayable.delete');
    Route::POST('/update-accounts-payable',[AccountsPayableController::class, 'updateAccountsPayable'])->name('accountsPayable.update');
    Route::post('/accounts-payable-by-id', [AccountsPayableController::class, 'getAccountsPayableById'])->name('accountsPayable.getById');

    // This is liabilities section
    Route::get('/liability', [LiabilityController::class, 'index'])->name('liability.index');
    Route::post('/create-liability', [LiabilityController::class, 'createLiability'])->name('liability.create');
    Route::get('/get-liability', [LiabilityController::class, 'getLiabilty'])->name('liability.get');

});

require __DIR__.'/auth.php';
