<?php

use Modules\ResourceGroup\Actions\StoreNewResourceGroup;
use Modules\ResourceGroup\Actions\DeleteResourceGroup;
use Modules\ResourceGroup\Actions\UpdateResourceGroup;
use Modules\ResourceGroup\Actions\FindResourceGroup;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->prefix('resourcegroup')->group(function(){
    Route::post('/', StoreNewResourceGroup::class)->name('api.resourcegroup.store');
    Route::get('/{resourcegroup}', FindResourceGroup::class)->name('api.resourcegroup.find');
    Route::put('/{resourcegroup}', UpdateResourceGroup::class)->name('api.resourcegroup.update');
    Route::delete('/{resourcegroup}', DeleteResourceGroup::class)->name('api.resourcegroup.destroy');
});