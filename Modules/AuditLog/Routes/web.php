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


use Modules\AuditLog\Actions\IndexPage;

Route::prefix('auditlogs')->middleware('auth')->group(function() {
    Route::get('/', IndexPage::class)->name('audit.log.index');
});
