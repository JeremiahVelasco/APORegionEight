<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginRegister;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main.login');
});

Route::get('/profile', function () {
    return view('main.profile');
});

Route::get('/registerpage', [LoginRegister::class, 'registerpage']);
Route::post('/register', [LoginRegister::class, 'register']);


Route::get('/home', function () {
    return view('main.home');
});
Route::get('/directory', [UserController::class, 'directory'])->name('directory');
Route::get('/main/search', 'UserController@search');


//ADMIN ROUTES
Route::get('/admin', function () {
    return view('admin.adminlogin');
});
Route::get('/admindashboard', [AdminController::class, 'admindashboard'])->name('admindashboard');
Route::get('/adminusers', [AdminController::class, 'adminusers'])->name('adminusers');
Route::get('/adminchapters', [AdminController::class, 'adminchapters'])->name('adminchapters');
