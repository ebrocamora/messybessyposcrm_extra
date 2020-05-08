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

use Modules\Permission\Actions\ShowCreatePermissionForm;
use Modules\Permission\Actions\ShowEditPermissionForm;
use Modules\Permission\Actions\ViewPermission;
use Modules\Permission\Actions\DataTableOfPermission;

Route::prefix('permission')->middleware('auth')->group(function() {
    Route::get('/', DataTableOfPermission::class)->name('permission.index');
    Route::get('/create', ShowCreatePermissionForm::class)->name('permission.create');
    Route::get('/{permission}', ViewPermission::class)->name('permission.show');
    Route::get('/{permission}/edit', ShowEditPermissionForm::class)->name('permission.edit');
});
