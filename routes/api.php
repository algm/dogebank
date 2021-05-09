<?php

use App\Http\Controllers\Branches\BranchCreateController;
use App\Http\Controllers\Branches\BranchListController;
use App\Http\Controllers\Branches\BranchTopListController;
use App\Http\Controllers\Customers\CustomerCreateController;
use App\Http\Controllers\Transfers\Run\RunTransferController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'branches'], function () {
    Route::post('/', BranchCreateController::class);
    Route::get('/', BranchListController::class);
    Route::get('/top', BranchTopListController::class);
});

Route::group(['prefix' => 'customers'], function () {
    Route::post('/', CustomerCreateController::class);
});

Route::group(['prefix' => 'transfers'], function () {
    Route::post('/', RunTransferController::class);
});
