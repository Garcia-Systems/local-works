<?php

use App\Http\Controllers\AuditRequestController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/how-it-works', 'pages.how-it-works')->name('how-it-works');
Route::view('/digital-friction-audit', 'pages.digital-friction-audit')->name('digital-friction-audit');
Route::post('/digital-friction-audit', [AuditRequestController::class, 'store'])
    ->middleware('throttle:5,10')
    ->name('audit-requests.store');
Route::view('/problems', 'pages.problems')->name('problems');
Route::view('/about', 'pages.about')->name('about');
Route::view('/insights', 'pages.insights')->name('insights');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::get('/thank-you', function () {
    return session('audit_submitted')
        ? view('pages.thank-you')
        : redirect()->route('digital-friction-audit');
})->name('thank-you');
