<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

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

// All listings
Route::get('/', [ListingController::class, 'index']);


// Show create form
Route::get('/listings/create', 
[ListingController::class, 'create']);


// Store listing data
Route::post('/listings', 
[ListingController::class, 'store']);


// Single listing
Route::get('/listings/{listing}', 
[ListingController::class, 'show']);