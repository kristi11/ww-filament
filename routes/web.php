<?php

use App\Livewire\Cart;
use App\Livewire\CheckoutStatus;
use App\Livewire\ProductInfo;
use App\Livewire\StoreFront;
use App\Livewire\ViewOrder;
use App\Models\About;
use App\Models\Contact;
use App\Models\FAQdata;
use App\Models\Help;
use App\Models\Privacy;
use App\Models\Support;
use App\Models\Terms;
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
    return view('publicPage');
})->name('home');



Route::get('/faq', function () {
    return view('footer.FAQ', ['faq' => FAQdata::get()]);
})->name('faq');

Route::get('/help', function () {
    return view('footer.help', ['help' => Help::get()]);
})->name('help');

Route::get('/support', function () {
    return view('footer.support', ['support' => Support::get()]);
})->name('support');

Route::get('/privacy', function () {
    return view('footer.privacy', ['privacy' => Privacy::get()]);
})->name('privacy');

Route::get('/terms', function () {
    return view('footer.terms', ['terms' => Terms::get()]);
})->name('terms');

Route::get('/contact', function () {
    return view('footer.contact', ['contact' => Contact::get()]);
})->name('contact');

Route::get('/about', function () {
    return view('footer.about', ['about' => About::get()]);
})->name('about');
//Route::middleware(['auth', 'auth.session'])->group(function () {
//    Route::get('preview', function (){
//        $order = \App\Models\Order::first();
//        return new \App\Mail\OrderConfirmation($order);
//       $cart = \App\Models\User::first()->cart;
//       return new \App\Mail\AbandonedCartReminder($cart);
//    });
//});
//Route::middleware('public-page-check')->group(function () {
    Route::get('/shop', StoreFront::class)->name('shop');

    Route::get('/product/{product}',ProductInfo::class)->name('productInfo');

    Route::get('/cart',Cart::class)->name('cart');

    Route::get('/checkout-status',CheckoutStatus::class)->name('checkout-status');

    Route::get('/order/{orderId}',ViewOrder::class)->name('view-order');
//});
Route::redirect('/login', '/admin/login')->name('redirectedLogin');
