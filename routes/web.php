<?php

use App\Http\Controllers\FrontEnd\HomePageController;
use App\Http\Controllers\FrontEnd\UserBalance;
use App\Http\Controllers\FrontEnd\UserProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
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

require __DIR__.'/admin.php';
Route::get('/',[HomePageController::class,'index'])->name('home');



Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', function () {
        return view('frontend.user.dashboard');
    })->name('user.dashboard');
    Route::get('/wallet', [UserBalance::class, 'wallet'])->name('user.wallet');
    Route::post('/add-wallet', [UserBalance::class, 'add_balance'])->name('user.add_balance');

    Route::get('user/profile/{user}', [UserProfileController::class, 'edit'])->name('user.profile');
    Route::post('user/profile/update/{user}', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::post('user/password/update/{user}', [UserProfileController::class, 'password_update'])->name('user.password.update');
    Route::delete('/user/profile/destroy/{user}', [UserProfileController::class, 'destroy'])->name('user.profile.destroy');
    Route::post('/profile', [ProfileController::class, 'edit'])->name('dashboard');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
<<<<<<< HEAD
    Route::get('/logout', function () {
        auth('web')->logout();
        return redirect()->route('home');
    })->name('user.logout');
=======
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'edit'])->name('dashboard');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
>>>>>>> nomandev
});

require __DIR__.'/auth.php';

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');



require __DIR__.'/adminauth.php';
