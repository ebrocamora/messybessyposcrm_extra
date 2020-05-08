<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\User\Actions\ShowAssignUserRoleForm;
use Modules\User\Actions\ShowCreateUserForm;
use Modules\User\Actions\ShowEditUserForm;
use Modules\User\Actions\ViewUser;
use Modules\User\Actions\DataTableOfUser;

Route::prefix('user')->middleware('auth')->group(function() {
    Route::get('/', DataTableOfUser::class)->name('user.index');
    Route::get('/{user}/roles', ShowAssignUserRoleForm::class)->name('user.assign.roles');
});
