<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('register', [UserController::class,'register'])->name('register');
// Route::resource("/blogger",UserController::class);
// Route::resource("/blogger",PostController::class);

Auth::routes();

Route::get ("/",[PostController::class , 'accueil']);
Route::get ("login",[AuthController::class , 'index'])->name('login');
Route::post ("postlogin",[AuthController::class , 'login'])->name('postlogin');
Route::post ("newpost",[PostController::class , 'store'])->name('newpost');
Route::post ("newcomment",[PostController::class , 'addComment'])->name('newcomment');
Route::get ("signup",[AuthController::class , 'signup'])->name('register');
Route::post ("postsignup",[AuthController::class , 'signupsave'])->name('postsignup');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');