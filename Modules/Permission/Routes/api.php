<?php

use Modules\Permission\Actions\GetParentPermissions;
use Modules\Permission\Actions\StoreNewPermission;
use Modules\Permission\Actions\DeletePermission;
use Modules\Permission\Actions\UpdatePermission;
use Modules\Permission\Actions\FindPermission;

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
Route::middleware('auth:api')->prefix('permission')->group(function () {
    Route::post('/', StoreNewPermission::class)->name('api.permission.store');
    Route::get('/{permission}', FindPermission::class)->name('api.permission.find');
    Route::put('/{permission}', UpdatePermission::class)->name('api.permission.update');
    Route::delete('/{permission}', DeletePermission::class)->name('api.permission.destroy');

    //get application resource group parent permissions
    Route::get('/parent-permissions/{application}/{resource_group}', GetParentPermissions::class)->name('api.permission.application.group.parent-permissions');
});
