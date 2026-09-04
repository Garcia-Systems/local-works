<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/how-it-works', 'pages.how-it-works')->name('how-it-works');
Route::view('/digital-friction-audit', 'pages.digital-friction-audit')->name('digital-friction-audit');
Route::view('/problems', 'pages.problems')->name('problems');
Route::view('/about', 'pages.about')->name('about');
Route::view('/insights', 'pages.insights')->name('insights');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/thank-you', 'pages.thank-you')->name('thank-you');
