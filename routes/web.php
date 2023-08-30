<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortenController;
use App\Models\Url;

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
$hashRegex = '[0-9a-z]+';

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/ajax/shorten',[ShortenController::class,'add'])->name('ajax.shorten');

Route::post('/ajax/shorten',[ShortenController::class,'storeUrl']);

Route::get('/user/link',[ShortenController::class,'list'])->name('list.url');

Route::get('/view/{hash}',[ShortenController::class,'viewUrl'])->name('url_view')->where([
    'hash' => $hashRegex
]);

Route::get('/ajax/delete/{hash}',[ShortenController::class,'deleteUrl']);

Route::get('/ajax/statistic/{hash}',[ShortenController::class,'statistics']);

Route::get('/statistic/{hash}',[ShortenController::class,'viewStatistics']);

require __DIR__.'/auth.php';
