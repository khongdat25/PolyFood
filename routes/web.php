<?php

use App\Http\Controllers\ProfileController;
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

use App\Http\Controllers\users\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

<<<<<<< HEAD
use App\Http\Controllers\VideoController;

Route::middleware('auth')->group(function () {
    // Profile page (channel view)
    Route::get('/profile', [VideoController::class, 'index'])->name('profile');

    // Avatar upload
    Route::post('/profile/avatar', [VideoController::class, 'updateAvatar'])->name('profile.avatar');

    // Video CRUD
    Route::resource('videos', VideoController::class)->except(['index']);

    // Public channel profile
    Route::get('/channel/{id}', [VideoController::class, 'channel'])->name('channel');

    // Legacy profile edit (keep for header link compatibility)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
=======
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
>>>>>>> 7ff808b13b4bb91e0aea268c5669f62f91580133
});

require __DIR__.'/auth.php';
