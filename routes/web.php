<?php


use App\Http\Controllers\FrontEnd\BookingController;
use App\Http\Controllers\FrontEnd\HomePageController;
use App\Http\Controllers\FrontEnd\SubscriberController;
use App\Http\Controllers\FrontEnd\UserBalance;
use App\Http\Controllers\FrontEnd\UserProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
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

Route::get('/flight/search', [\App\Http\Controllers\FrontEnd\FlightSearchController::class, 'flight_search'])->name('flight.search');
Route::get('/flight/search-rt', [\App\Http\Controllers\FrontEnd\FlightSearchController::class, 'flight_search_rt'])->name('flight.search-rt');
Route::get('/flight/search-mc', [\App\Http\Controllers\FrontEnd\FlightSearchController::class, 'flight_search_mc'])->name('flight.search-mc');


Route::get('/airports', [\App\Http\Controllers\FrontEnd\FlightSearchController::class, 'airports'])->name('airports');
Route::get('/banks', [\App\Http\Controllers\FrontEnd\BankController::class, 'banks'])->name('banks');

require __DIR__.'/admin.php';
Route::get('/',[HomePageController::class,'index'])->name('home');

Route::middleware('auth:web')->group(function () {
    Route::get('/user', function () {
        return view('frontend.user.dashboard');
    })->name('user.dashboard');
    Route::get('/wallet', [UserBalance::class, 'wallet'])->name('user.wallet');
    Route::post('/add-wallet-amar-pay', [UserBalance::class, 'add_balance_amar_pay'])->name('user.add_balance_amar_pay');

    Route::get('user/profile', [UserProfileController::class, 'edit'])->name('user.profile');
    Route::post('user/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::post('user/password/update', [UserProfileController::class, 'password_update'])->name('user.password.update');
    Route::delete('/user/profile/destroy/{user}', [UserProfileController::class, 'destroy'])->name('user.profile.destroy');
    Route::post('/profile', [ProfileController::class, 'edit'])->name('dashboard');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('user/booking/flight',[BookingController::class,'flights'])->name('user.booking_flight');
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
    Route::GET('/flight-booking', [\App\Http\Controllers\FrontEnd\FlightBookingController::class, 'flight_booking'])->name('flight_booking');
    Route::POST('/flight-booking/step2', [\App\Http\Controllers\FrontEnd\FlightBookingController::class, 'flight_booking_step2'])->name('flight_booking_step2');

    Route::post('/add/passenger', [\App\Http\Controllers\FrontEnd\FlightBookingController::class, 'add_passenger'])->name('add.passenger');
    Route::get('/passenger/session/{SearchId}', [\App\Http\Controllers\FrontEnd\FlightBookingController::class, 'passengerSession']);
    Route::get('order/{id}',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'order_details'])->name('order_details');
    Route::get('order/{id}/refresh',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'order_refresh'])->name('order_refresh');
    Route::get('order/{id}/ticket-issue',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'ticket_issue'])->name('ticket_issue');
    Route::get('order/{id}/cancel',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'cancel_ticket'])->name('cancel_ticket');
    Route::get('order/{id}/booking-invoice',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'download_booking_invoice'])->name('download_booking_invoice');
    Route::post('order/pay/{id}',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'order_pay'])->name('order_pay');
    Route::get('order/{id}/downloadTicket/{ticket}/{pax_index}',[\App\Http\Controllers\FrontEnd\FlightBookingController::class,'downloadTicket'])->name('downloadTicket');
    Route::get('/bank-deposit/{id}',[\App\Http\Controllers\Admin\DepositBalance::class,'bank_deposit'])->name('user.bank_deposit');
    Route::post('/bank-deposit/{id}',[\App\Http\Controllers\Admin\DepositBalance::class,'bank_deposit_submit'])->name('user.bank_deposit_submit');
    Route::post('/bank-deposit',[\App\Http\Controllers\Admin\DepositBalance::class,'bank_deposit_store'])->name('bank_deposit');
    Route::post('/passenger-update',[\App\Http\Controllers\GlobalController::class,'passenger_update'])->name('passenger_update');
    Route::get('/deposit',[\App\Http\Controllers\GlobalController::class,'deposit'])->name('deposit');
    Route::get('/bank-details',[\App\Http\Controllers\GlobalController::class,'bank_details'])->name('bank_details');

});

require __DIR__.'/auth.php';


require __DIR__.'/adminauth.php';
//pages
Route::post('subscribe',[SubscriberController::class,'subscribe'])->name('subscribe');
Route::get('/about', function () {return view('frontend.pages.about');})->name('about');
Route::get('/testimonials', function () {return view('frontend.pages.testimonials');})->name('testimonials');
Route::get('/privacy-policy', function () {return view('frontend.pages.privacy');})->name('privacy_policy');
Route::get('/refund-policy', function () {return view('frontend.pages.refund');})->name('refund_policy');
Route::get('/cancellation-policy', function () {return view('frontend.pages.cancellation');})->name('cancellation_policy');
Route::get('/terms', function () {return view('frontend.pages.terms');})->name('terms_conditions');
Route::get('/visa', function () {return view('frontend.pages.visa');})->name('visa');
Route::get('/contact', function () {return view('frontend.pages.contact');})->name('contact');

Route::get('get-user-order',[\App\Http\Controllers\Admin\DepositBalance::class,'get_user_orders'])->name('get_user_orders');


Route::post('/success-fund',[\App\Http\Controllers\AmarPayController::class,'success_fund'])->name('success_fund');
Route::post('/fail-fund',[\App\Http\Controllers\AmarPayController::class,'fail_fund'])->name('fail_fund');
Route::get('/cancel-fund',[\App\Http\Controllers\AmarPayController::class,'cancel_fund'])->name('cancel_fund');

Route::post('/success-flight-pay',[\App\Http\Controllers\AmarPayController::class,'success_flight_pay'])->name('success_flight_pay');
Route::post('/fail-flight-pay',[\App\Http\Controllers\AmarPayController::class,'fail_flight_pay'])->name('fail_flight_pay');
Route::get('/cancel-flight-pay',[\App\Http\Controllers\AmarPayController::class,'cancel_flight_pay'])->name('cancel_flight_pay');

require __DIR__.'/command.php';
Route::get('test',function (){

   return view('emails.send');
});

