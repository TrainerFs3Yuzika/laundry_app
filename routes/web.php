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

// Route::get('/', function () {
//     return view('frontend.master', ['title' => 'Home']);
// })->name('home');

Route::controller('App\Http\Controllers\Frontend\MasterController')->group(function () {
    Route::get('/', 'index')->name('home');
});

//Auth
Route::controller('App\Http\Controllers\AuthController')->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/register', 'RegisterIndex')->name('register');
    Route::post('/register', 'register')->name('register.post');
});



Route::middleware(['auth'])->group(function () {
    Route::controller('App\Http\Controllers\ProfileController')->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::post('/profile', 'updateProfile')->name('profile.update');
        Route::post('/profile/password', 'updatePassword')->name('profile.password');
    });
});


//Dashboard
Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::controller('App\Http\Controllers\Admin\DashboardController')->group(function () {
        Route::get('/dashboard', 'index')->name('admin.dashboard');
    });
    //Users
    Route::controller('App\Http\Controllers\Admin\UserController')->group(function () {
        Route::get('/users', 'index')->name('admin.users');
        Route::get('/users/create', 'create')->name('admin.users.create');
        Route::post('/users/store', 'store')->name('admin.users.store');
        Route::get('/users/edit/{id}', 'edit')->name('admin.users.edit');
        Route::put('/users/update/{id}', 'update')->name('admin.users.update');
        Route::delete('/users/{id}', 'destroy')->name('admin.users.destroy');
    });

    //product
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->except([]);


    //order
    Route::controller('App\Http\Controllers\Admin\OrderController')->group(function () {
        Route::get('/orders', 'index')->name('admin.orders');
        Route::post('/orders/update-status/{id}', 'updateStatus')->name('admin.orders.updateStatus');
        Route::get('/invoice/{order}', 'invoice')->name('admin.orders.invoice');
        Route::get('/orders/{order}/invoice-download', 'downloadInvoice')->name('admin.orders.invoice-download');
    });

    //setting
    Route::controller('App\Http\Controllers\Admin\SettingController')->group(function () {
        Route::get('/settings', 'index')->name('admin.settings');
        Route::put('/settings/update', 'update')->name('admin.settings.update');

    });

    //ratings
    Route::controller('App\Http\Controllers\Admin\RatingController')->group(function () {
        Route::get('/ratings', 'index')->name('admin.ratings');
    });

    Route::resource('discounts', App\Http\Controllers\Admin\DiscountController::class);

});

//Customer
Route::group(['middleware' => ['auth', 'checkRole:customer'], 'prefix' => 'customer'], function () {
    Route::controller('App\Http\Controllers\Customer\DashboardController')->group(function () {
        Route::get('/dashboard', 'index')->name('customer.dashboard.index');
        Route::post('/track-order',  'trackOrder')->name('customer.trackOrder');
    });

    //order
    Route::controller('App\Http\Controllers\Customer\OrderController')->group(function () {
        Route::get('/orders', 'index')->name('customer.orders');
        Route::post('/orders/store', 'store')->name('customer.orders.store');
        Route::get('/invoice/{order}', 'invoice')->name('customer.orders.invoice');
        Route::get('/orders/history', 'history')->name('customer.orders.history');
        Route::get('/payment/{order}', 'pay')->name('customer.payment');
        Route::patch('/orders/{order}/rating', 'updateRating')->name('customer.orders.updateRating');
        Route::get('/orders/{order}/invoice-download', 'downloadInvoice')->name('customer.orders.invoice-download');
        //check-discount
        Route::get('/check-discount', 'checkDiscount')->name('check.discount');

    });

});

//midtrans
Route::post('midtrans/notification', 'App\Http\Controllers\Customer\OrderController@notificationHandler');


//Other Routes
Route::get('/about', function () {
    return view('frontend.about', ['title' => 'About Us']);
})->name('about');

Route::get('/blog', function () {
    return view('frontend.blog', ['title' => 'Pages']);
})->name('blog');

Route::get('/booking', function () {
    return view('frontend.booking', ['title' => 'Schedule Booking']);
})->name('booking');

Route::get('/contact', function () {
    return view('frontend.contact', ['title' => 'Contact Us']);
})->name('contact');

Route::get('/location', function () {
    return view('frontend.location', ['title' => 'Washing Points']);
})->name('location');

Route::get('/price', function () {
    return view('frontend.price', ['title' => 'Pricing']);
})->name('price');

Route::get('/service', function () {
    return view('frontend.service', ['title' => 'Our Services']);
})->name('service');

Route::get('/single', function () {
    return view('frontend.single', ['title' => 'Detail Page']);
})->name('single');

Route::get('/team', function () {
    return view('frontend.team', ['title' => 'Our Team']);
})->name('team');
