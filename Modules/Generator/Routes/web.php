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


use Modules\Generator\Actions\ShowModuleGeneratorPage;

Route::prefix('generator')->middleware('auth')->group(function() {
    Route::get('/', ShowModuleGeneratorPage::class)->name('generator.index');
});
