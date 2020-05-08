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

use Modules\Application\Actions\DatatableOfApplication;
use Modules\Application\Actions\DeleteApplication;
use Modules\Application\Actions\ShowCreateApplciationForm;
use Modules\Application\Actions\EditApplication;

Route::prefix('application')->middleware('auth')->group(function () {
    Route::get('/', DatatableOfApplication::class)->name('application.index');
    Route::get('/create', ShowCreateApplciationForm::class)->name('application.create');
    Route::get('/{application}/edit', EditApplication::class)->name('application.edit');
    Route::delete('/{application}', DeleteApplication::class)->name('application.delete');
});
