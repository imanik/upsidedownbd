<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register frontend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "frontend" middleware group. Now create something great!
|
*/



Route::get('/home', [FrontendController::class, 'home'])->name('home');
Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('aboutUs');
Route::get('/promotions', [FrontendController::class, 'promotions'])->name('promotions');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/gallery-uttara', [FrontendController::class, 'galleryUttara'])->name('gallery_uttara');
Route::get('/buy-ticket', [FrontendController::class, 'comingSoon'])->name('buy_ticket');
Route::get('/contacts', [FrontendController::class, 'contacts'])->name('contacts');
Route::get('/privacy', [FrontendController::class, 'privacy'])->name('privacy_policy');
Route::get('/refund', [FrontendController::class, 'refund'])->name('return_refund_policy');
Route::get('/terms', [FrontendController::class, 'terms'])->name('terms_n_conditions');
Route::get('/menu', [FrontendController::class, 'menu'])->name('menu');
Route::get('/franchise', [FrontendController::class, 'franchise'])->name('franchise');
Route::get('/inquiry', [FrontendController::class, 'inquiry'])->name('inquiry');


Route::post('/franchise_store', [FrontendController::class, 'franchise_store'])->name('franchise_store');
