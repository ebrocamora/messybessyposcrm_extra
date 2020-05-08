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

use Modules\ResourceGroup\Actions\ShowCreateResourceGroupForm;
use Modules\ResourceGroup\Actions\ShowEditResourceGroupForm;
use Modules\ResourceGroup\Actions\ViewResourceGroup;
use Modules\ResourceGroup\Actions\DataTableOfResourceGroup;

Route::prefix('resourcegroup')->middleware('auth')->group(function() {
    Route::get('/', DataTableOfResourceGroup::class)->name('resourcegroup.index');
    Route::get('/create', ShowCreateResourceGroupForm::class)->name('resourcegroup.create');
    Route::get('/{resourcegroup}/edit', ShowEditResourceGroupForm::class)->name('resourcegroup.edit');
});
