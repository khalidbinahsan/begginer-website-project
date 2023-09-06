<?php

use App\Http\Controllers\appInstaller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\termsController;
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
Route::get('/courses', [CoursesController::class, 'courseIndex']);
Route::get('/projects', [ProjectController::class, 'projectIndex']);
Route::get('/privacy', [PrivacyController::class, 'privacyIndex']);
Route::get('/terms', [termsController::class, 'termsIndex']);
Route::get('/contact', [ContactController::class, 'contactIndex']);
/* Create Permalink */
Route::get('postDetails/{id}/{title}', [HomeController::class, 'HomeIndex']);
/* Migration Route */
Route::get('/make_migration_file', [appInstaller::class, 'makeMigrationFile']);
Route::get('/run_migration_file', [appInstaller::class, 'runMigrationFile']);
// Cache Clear
Route::get('cache_clear', [appInstaller::class, 'AppCacheClear']);
// .env configuration
Route::get('/env-configuration', [appInstaller::class, 'EnvConfig']);
// Server Configuration Check
Route::get('/server_configuration_check', [appInstaller::class, 'serverConfigCheck']);
