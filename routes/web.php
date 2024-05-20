<?php

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
    return view('dashboard.index');
});


//Auth
Route::controller('App\Http\Controllers\AuthController')->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout');
});

//Dashboard
Route::group(['middleware' => 'auth'], function(){
    Route::controller('App\Http\Controllers\DashboardController')->group(function () {
        Route::get('/dashboard', 'index')->name('admin.dashboard');
    });
    //Users
    Route::controller('App\Http\Controllers\UserController')->group(function () {
        Route::get('/users', 'index')->name('admin.users');
        Route::get('/users/create', 'create')->name('admin.users.create');
        Route::post('/users/store', 'store')->name('admin.users.store');
        Route::get('/users/edit/{id}', 'edit')->name('admin.users.edit');
        Route::put('/users/update/{id}', 'update')->name('admin.users.update');
        Route::delete('/users/{id}', 'destroy')->name('admin.users.destroy');
    });
});
