<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get("/", [QuoteController::class, "today"])->name("quote.index");
Route::get("today", [QuoteController::class, "today"])->name("quote.today");
Route::get("today/new", [QuoteController::class, "new"])->name("quote.new");
Route::post("favorite-add", [QuoteController::class, "favorite_add"])->name("quote.favorite-add");
Route::post("favorite-remove", [QuoteController::class, "favorite_remove"])->name("quote.favorite-remove");
Route::get("favorite-quotes", [QuoteController::class, "favorite_quotes"])->name("quote.favorite-quotes")->middleware('host');
Route::get("quotes", [QuoteController::class, "five"])->name("quote.five")->middleware('guest');
Route::get("quotes/new", [QuoteController::class, "five_new"])->name("quote.five-new");
Route::get("secure-quotes", [QuoteController::class, "ten"])->name("quote.ten")->middleware('host');
Route::get("secure-quotes/new", [QuoteController::class, "ten_new"])->name("quote.ten-new");

require __DIR__.'/auth.php';
