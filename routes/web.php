<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('listings');
// });

//  All listing
Route::get('/',[ListingController::class, 'index'] );


// show create form
Route::get('/listings/create',[ListingController::class, 'create'])->middleware('auth');


// Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');


// Show Edit Data
Route::get('/listings/{listing}/edit',[ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class,  'manage'])->middleware('auth');


  // Single Listing
Route::get('/listings/{listing}',[ListingController::class, 'show']);

// Show Register Create Form
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

// Create New User
Route::post('/users',[UserController::class, 'store']);

// Logout User
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');


// Login User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Route::post('/users/authenticate', [UserController::class, 'testfuntion']);

