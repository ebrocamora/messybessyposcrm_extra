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

use Modules\Link\Actions\DatatableOfLink;
use Modules\Link\Actions\DeleteLink;
use Modules\Link\Actions\ShowEditLinkForm;
use Modules\Link\Actions\ShowCreateLinkForm;
use Modules\Link\Actions\ViewLink;

Route::prefix('link')->middleware('auth')->group(function () {
    Route::get('/', DatatableOfLink::class)->name('link.index');
    Route::get('/create', ShowCreateLinkForm::class)->name('link.create');
    Route::get('/{link}/show', ViewLink::class)->name('link.show');
    Route::get('/{id}/edit', ShowEditLinkForm::class)->name('link.edit');
    Route::delete('/{link}', DeleteLink::class)->name('link.delete');
});
