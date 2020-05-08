<?php

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

use Modules\AuditLog\Actions\GetUserAuditLogs;

Route::middleware('auth:api')->prefix('auditlogs')->group(function(){
    Route::get('/auditlogs/user/{user}', GetUserAuditLogs::class)->name('api.audit.logs.user.get');
});