<?php

use App\Http\Controllers\Api\BannerApiController;
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

Route::middleware('api')->group(function () {
    Route::post('/banners/{banner}/view', [BannerApiController::class, 'viewBanner']);
    Route::post('/banners/{banner}/click', [BannerApiController::class, 'clickBanner']);
    Route::get('/banners', [BannerApiController::class, 'index']);
});
