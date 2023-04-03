<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\servicesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\Gallery;
use App\Http\Controllers\LoginController;
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

Route::get('/', [HomeController::class, 'HomeIndex'])->middleware('loginCheck');
Route::get('/visitor', [VisitorController::class, 'VisitorList'])->middleware('loginCheck');
// Service page route
Route::get('/services', [servicesController::class, 'ServicesItem'])->middleware('loginCheck');
Route::get('/getServicesData', [servicesController::class, 'getServiceData'])->middleware('loginCheck');
Route::post('/deleteService', [servicesController::class, 'deleteServiceData'])->middleware('loginCheck');
Route::post('/getServiceDataById', [servicesController::class, 'getDataById'])->middleware('loginCheck');
Route::post('/updateServiceData', [servicesController::class, 'serviceUpdate'])->middleware('loginCheck');
Route::post('/addNewService', [servicesController::class, 'addNewServices'])->middleware('loginCheck');
// Courses page
Route::get('/courses', [CoursesController::class, 'coursesIndex'])->middleware('loginCheck');
Route::get('/getCourseData', [CoursesController::class, 'getCourseData'])->middleware('loginCheck');
Route::post('/addCourse', [CoursesController::class, 'addNewCourse'])->middleware('loginCheck');
Route::post('/courseDelete', [CoursesController::class, 'courseDataDelete'])->middleware('loginCheck');
Route::post('/getCourseById', [CoursesController::class, 'getDataById'])->middleware('loginCheck');
Route::post('/courseUpdate', [CoursesController::class, 'courseDataUpdate'])->middleware('loginCheck');
// Project page
Route::get('/project', [ProjectController::class, 'projectIndex'])->middleware('loginCheck');
Route::get('/getProjectData', [ProjectController::class, 'getProjectData'])->middleware('loginCheck');
Route::post('/addNewProject', [ProjectController::class, 'addNewProject'])->middleware('loginCheck');
Route::post('/deleteProject', [ProjectController::class, 'projectDataDelete'])->middleware('loginCheck');
Route::post('/getProjectById', [ProjectController::class, 'getProjectById'])->middleware('loginCheck');
Route::post('/updateProjectData', [ProjectController::class, 'projectDataUpdate'])->middleware('loginCheck');
// Message
Route::get('/message', [MessageController::class, 'messageIndex'])->middleware('loginCheck');
Route::get('/allMessage', [MessageController::class, 'allMessage'])->middleware('loginCheck');
Route::post('/deleteMessage', [MessageController::class, 'messageDataDelete'])->middleware('loginCheck');
// Review
Route::get('/review', [ReviewController::class, 'ReviewIndex'])->middleware('loginCheck');
Route::get('/allReview', [ReviewController::class, 'getReviewData'])->middleware('loginCheck');
Route::post('/add_new_review', [ReviewController::class, 'addNewReview'])->middleware('loginCheck');
Route::post('/review_delete', [ReviewController::class, 'reviewDataDelete'])->middleware('loginCheck');
Route::post('/get_review', [ReviewController::class, 'getReviewById'])->middleware('loginCheck');
Route::post('/update_review', [ReviewController::class, 'reviewUpdate'])->middleware('loginCheck');
// Gallery
Route::get('/gallery', [Gallery::class, 'galleryIndex'])->middleware('loginCheck');
Route::post('/image_upload', [Gallery::class, 'uploadImage'])->middleware('loginCheck');
Route::get('/image_load', [Gallery::class, 'imageLoad'])->middleware('loginCheck');
Route::get('/image_load_more/{id}', [Gallery::class, 'imageLoadMore'])->middleware('loginCheck');
Route::post('/image_delete', [Gallery::class, 'imageDelete'])->middleware('loginCheck');
// Admin Login
Route::get('/login', [LoginController::class, 'loginIndex']);
Route::post('/on_login', [LoginController::class, 'onLogin']);
Route::get('/log_out', [LoginController::class, 'onLogOut']);

