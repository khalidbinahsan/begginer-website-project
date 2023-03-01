<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\servicesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;

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
// Courses page
Route::get('/courses', [CoursesController::class, 'coursesIndex']);
Route::get('/getCourseData', [CoursesController::class, 'getCourseData']);
Route::post('/addCourse', [CoursesController::class, 'addNewCourse']);
Route::post('/courseDelete', [CoursesController::class, 'courseDataDelete']);
Route::post('/getCourseById', [CoursesController::class, 'getDataById']);
Route::post('/courseUpdate', [CoursesController::class, 'courseDataUpdate']);
// Project page
Route::get('/project', [ProjectController::class, 'projectIndex']);
Route::get('/getProjectData', [ProjectController::class, 'getProjectData']);
Route::post('/addNewProject', [ProjectController::class, 'addNewProject']);
Route::post('/deleteProject', [ProjectController::class, 'projectDataDelete']);
Route::post('/getProjectById', [ProjectController::class, 'getProjectById']);
Route::post('/updateProjectData', [ProjectController::class, 'projectDataUpdate']);
// Message
Route::get('/message', [MessageController::class, 'messageIndex']);
Route::get('/allMessage', [MessageController::class, 'allMessage']);
Route::post('/deleteMessage', [MessageController::class, 'messageDataDelete']);
// Review
Route::get('/review', [ReviewController::class, 'ReviewIndex']);
Route::get('/allReview', [ReviewController::class, 'getReviewData']);
Route::post('/add_new_review', [ReviewController::class, 'addNewReview']);
Route::post('/review_delete', [ReviewController::class, 'reviewDataDelete']);
Route::post('/get_review', [ReviewController::class, 'getReviewById']);
Route::post('/update_review', [ReviewController::class, 'reviewUpdate']);

