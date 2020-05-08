<?php

use Illuminate\Http\Request;
use Modules\Link\Actions\GetApplicationParentLinks;
use Modules\Link\Actions\GetLinkDetails;
use Modules\Link\Actions\StoreNewLink;
use Modules\Link\Actions\UpdateLink;
use Modules\Link\Http\Controllers\GetLinkDetailsController;
use Modules\Link\Http\Controllers\GetParentLinksController;
use Modules\Link\Http\Controllers\StoreLinkController;

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

Route::middleware('auth:api')->prefix('link')->group(function () {
    Route::post('/create', StoreNewLink::class)->name('api.link.store');
    Route::get('/{link}/show', GetLinkDetails::class)->name('api.link.show');
    Route::put('/{link}', UpdateLink::class)->name('api.link.update');
    Route::get('/parent/{application}', GetApplicationParentLinks::class)->name('api.link.application.parent.links');
});