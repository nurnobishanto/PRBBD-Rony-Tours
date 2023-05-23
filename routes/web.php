<?php

use App\Http\Controllers\Frontend\FlightBookingController;
use App\Http\Controllers\FrontEnd\HomePageController;
use App\Http\Controllers\FrontEnd\SubscriberController;
use App\Http\Controllers\FrontEnd\UserBalance;
use App\Http\Controllers\FrontEnd\UserProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Frontend\FlightSearchController;
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
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('dashboard');
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

// Flight Search
Route::get('/flight/search', [FlightSearchController::class, 'flight_search'])->name('flight.search');


require __DIR__.'/admin.php';
Route::get('/',[HomePageController::class,'index'])->name('home');

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', function () {
        return view('frontend.user.dashboard');
    })->name('user.dashboard');
    Route::get('user/wallet', [UserBalance::class, 'wallet'])->name('user.wallet');
    Route::post('user/add-wallet', [UserBalance::class, 'add_balance_SSLCOMMERZ'])->name('user.add_balance_SSLCOMMERZ');

    Route::get('user/profile', [UserProfileController::class, 'edit'])->name('user.profile');
    Route::post('user/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::post('user/password/update', [UserProfileController::class, 'password_update'])->name('user.password.update');
    Route::delete('/user/profile/destroy', [UserProfileController::class, 'destroy'])->name('user.profile.destroy');
    Route::post('/profile', [ProfileController::class, 'edit'])->name('dashboard');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('user/support', [SubscriberController::class, 'supports'])->name('user.support');
    Route::get('user/support/{id}', [SubscriberController::class, 'support_chat'])->name('user.support_chat');
    Route::post('user/chat/add-msg/{id}', [SubscriberController::class, 'send_msg'])->name('user.send_msg');
    Route::get('user/chat/close/{id}', [SubscriberController::class, 'chat_end'])->name('user.chat_end');
    Route::post('user/support/create', [SubscriberController::class, 'support_create'])->name('user.support_create');
    Route::get('/logout', function () {
        auth('web')->logout();
        return redirect()->route('home');
    })->name('user.logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'edit'])->name('dashboard');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/flight/booking', [FlightBookingController::class, 'flight_booking'])->name('flight_booking');

});

require __DIR__.'/auth.php';

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

require __DIR__.'/adminauth.php';
//pages
Route::get('/about', function () {return view('frontend.pages.about');})->name('about');
Route::get('/privacy-policy', function () {return view('frontend.pages.privacy');})->name('privacy_policy');
Route::get('/terms-and-conditions', function () {return view('frontend.pages.terms');})->name('terms_conditions');
Route::get('/testimonials', function () {return view('frontend.pages.testimonials');})->name('testimonials');

require __DIR__.'/command.php';
