<?php

use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::resource('partners', PartnerController::class);
Route::get('/partners/products/{partner}', [PartnerController::class, 'products'])->name('partners.products');
