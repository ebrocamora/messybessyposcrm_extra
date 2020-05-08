<?php

use Modules\Role\Actions\GetAllRoles;
use Modules\Role\Actions\StoreNewRole;
use Modules\Role\Actions\DeleteRole;
use Modules\Role\Actions\UpdateRole;
use Modules\Role\Actions\FindRole;

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
Route::middleware('auth:api')->prefix('role')->group(function () {
    Route::get('/', GetAllRoles::class)->name('api.role.index');
    Route::post('/', StoreNewRole::class)->name('api.role.store');
    Route::get('/{role}', FindRole::class)->name('api.role.find');
    Route::put('/{role}', UpdateRole::class)->name('api.role.update');
    Route::delete('/{role}', DeleteRole::class)->name('api.role.destroy');
});
