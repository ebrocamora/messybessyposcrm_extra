<?php

use Illuminate\Http\Request;
use Modules\Application\Actions\DeleteApplication;
use Modules\Application\Actions\GetApplicationResources;
use Modules\Application\Actions\GetAllApplications;
use Modules\Application\Actions\EditApplication;
use Modules\Application\Actions\StoreNewApplication;
use Modules\Application\Actions\UpdateApplication;
use Modules\Application\Http\Controllers\GetAllApplicationController;
use Modules\Application\Http\Controllers\GetApplicationResourceController;

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

Route::middleware('auth:api')->prefix('application')->group(function(){
    Route::get('/', GetAllApplications::class)->name('api.application.index');
    Route::post('/create', StoreNewApplication::class)->name('api.application.store');
    Route::get('/{application}/show', EditApplication::class)->name('api.application.view');
    Route::put('/{application}/edit', UpdateApplication::class)->name('api.application.update');
    Route::delete('/{application}', DeleteApplication::class)->name('api.application.delete');
    Route::get('{application}/resources', GetApplicationResources::class)->name('api.application.resources');
});
