<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\servicesController;

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

Route::get('/', [HomeController::class, 'HomeIndex']);
Route::get('/visitor', [VisitorController::class, 'VisitorList']);
// Service page route
Route::get('/services', [servicesController::class, 'ServicesItem']);
Route::get('/getServicesData', [servicesController::class, 'getServiceData']);
Route::post('/deleteService', [servicesController::class, 'deleteServiceData']);
Route::post('/getServiceDataById', [servicesController::class, 'getDataById']);
Route::post('/updateServiceData', [servicesController::class, 'serviceUpdate']);
Route::post('/addNewService', [servicesController::class, 'addNewServices']);
