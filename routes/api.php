<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PolylineController;
use App\Http\Controllers\PolygonController;
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

// Url untuk merespon permintaan pengguna --> url untuk mengakses /points yang akan terhubung dengan class indox pada controller
//GeoJSON Points metode get untuk mengambil data
Route::get('/points', [PointController::class, 'index'])->name('api.points');
Route::get('/point/{id}', [PointController::class, 'show'])->name('api.point');

//GeoJSON Polyline
Route::get('/polylines', [PolylineController::class, 'index'])->name('api.polylines');
Route::get('/polyline/{id}', [PolylineController::class, 'show'])->name('api.polyline');

//GeoJSON Polygon
Route::get('/polygons', [PolygonController::class, 'index'])->name('api.polygons');
Route::get('/polygon/{id}', [PolygonController::class, 'show'])->name('api.polygon');
