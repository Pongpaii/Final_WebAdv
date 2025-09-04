<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;

//home page
Route::get('/', [TestController::class, 'index']);

//admin crud
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/adding',  [AdminController::class, 'adding']);
Route::post('/admin',  [AdminController::class, 'create']);// ส่งไป function create admin controller
Route::get('/admin/{id}',  [AdminController::class, 'edit']);
Route::put('/admin/{id}',  [AdminController::class, 'update']);
Route::delete('/admin/remove/{id}',  [AdminController::class, 'remove']); //ส่งไป remove admin controller
Route::get('/admin/reset/{id}',  [AdminController::class, 'reset']); //reset ใน admin controller
Route::put('/admin/reset/{id}',  [AdminController::class, 'resetPassword']);





//test crud
Route::get('/test', [TestController::class, 'index']);
Route::get('/test/adding',  [TestController::class, 'adding']);
Route::post('/test',  [TestController::class, 'create']);
Route::get('/test/{id}',  [TestController::class, 'edit']);
Route::put('/test/{id}',  [TestController::class, 'update']);
Route::delete('/test/remove/{id}',  [TestController::class, 'remove']);

//prod crud
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/adding',  [ProductController::class, 'adding']);
Route::post('/product',  [ProductController::class, 'create']);
Route::get('/product/{id}',  [ProductController::class, 'edit']);
Route::put('/product/{id}',  [ProductController::class, 'update']);
Route::delete('/product/remove/{id}',  [ProductController::class, 'remove']);


//stud crud
Route::get('/student', [StudentController::class, 'index']);
Route::get('/student/adding',  [StudentController::class, 'adding']);
Route::post('/student',  [StudentController::class, 'create']);
Route::get('/student/{id}',  [StudentController::class, 'edit']);
Route::put('/student/{id}',  [StudentController::class, 'update']);
Route::delete('/student/remove/{id}',  [StudentController::class, 'remove']);

