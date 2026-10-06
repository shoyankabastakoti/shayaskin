<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('pages.home'))->name('home');
Route::get('/makeup', fn () => view('pages.makeup'))->name('makeup');
Route::get('/skincare', fn () => view('pages.skincare'))->name('skincare');
Route::get('/about', fn () => view('pages.about'))->name('about');
Route::get('/contact', fn () => view('pages.contact'))->name('contact');
