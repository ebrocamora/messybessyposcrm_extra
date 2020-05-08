<?php

use Modules\User\Actions\SetUserRole;
use Modules\User\Actions\FindUser;

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
Route::middleware('auth:api')->prefix('user')->group(function () {
    Route::get('/{user}', FindUser::class)->name('api.user.find');
    Route::put('/{user}/roles', SetUserRole::class)->name('api.user.assign.roles');
});
