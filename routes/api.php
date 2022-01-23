<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/employee',[EmployeeController::class, 'index']);
//Route::get('/employee/{id}',[EmployeeController::class, 'show']);
//Route::post('/employee', [EmployeeController::class,'store']);
Route::post('/employee/{id}', [EmployeeController::class,'update']);
//Route::delete('/employee/{id}', [EmployeeController::class,'destroy']);
Route::resource('/employee',EmployeeController::class)->except(['create','edit','update']);