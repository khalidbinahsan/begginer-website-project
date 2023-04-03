<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
Route::post('/contactSubmitted', [HomeController::class, 'contactSubmitted']);

/* Other page route */
Route::get('/courses', [\App\Http\Controllers\CoursesController::class, 'courseIndex']);
Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'projectIndex']);
Route::get('/privacy', [\App\Http\Controllers\PrivacyController::class, 'privacyIndex']);
Route::get('/terms', [\App\Http\Controllers\termsController::class, 'termsIndex']);
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'contactIndex']);
/* Create Permalink */
Route::get('postDetails/{id}/{title}', [HomeController::class, 'HomeIndex']);
