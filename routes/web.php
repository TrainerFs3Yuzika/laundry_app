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
    return view('frontend.master');
});



//Auth
Route::controller('App\Http\Controllers\AuthController')->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/register', 'registerIndex')->name('register');
    Route::post('/register', 'register')->name('register.post');
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

    //product
    Route::resource('products', App\Http\Controllers\ProductController::class)->except([]);

    //category
    Route::resource('categories', App\Http\Controllers\CategoryController::class)->except([]);

    //transaction
    Route::controller('App\Http\Controllers\TransactionController')->group(function () {
        Route::get('/transactions', 'index')->name('transactions');
        Route::get('/transactions/create', 'create')->name('admin.transactions.create');
        Route::post('/transactions/store', 'store')->name('admin.transactions.store');
        Route::get('/transactions/edit/{id}', 'edit')->name('admin.transactions.edit');
        Route::put('/transactions/update/{id}', 'update')->name('admin.transactions.update');
        Route::delete('/transactions/{id}', 'destroy')->name('admin.transactions.destroy');
    });
});
