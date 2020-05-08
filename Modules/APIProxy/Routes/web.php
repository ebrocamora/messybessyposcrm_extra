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

use Modules\APIProxy\Actions\HandleRequest;

Route::prefix('ajax')->middleware('auth')->group(function () {
    Route::match(['GET', 'POST'], '/', HandleRequest::class)->name('api.proxy.endpoint');
});
