<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\MarqueeController;
use App\Http\Controllers\Api\RevenueController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('signin', [AuthController::class, 'loginUser']);

Route::get('getMarquee', [MarqueeController::class, 'getMarquee']);

Route::get('eventsByMarquee/{id}', [EventController::class, 'getServicesData']);
Route::post('addEvent', [EventController::class, 'store']);
Route::patch('updateEvent', [EventController::class, 'update']);
Route::delete('delete/event', [EventController::class, 'delete']);

Route::post('addRevenue', [RevenueController::class, 'store']);
Route::get('allRevenues', [RevenueController::class, 'all']);
