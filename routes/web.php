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
});
Route::get('/category', function () {
    return view('admin.category.index');
});
Route::get('/category/create', function () {
    return view('admin.category.create');
});
Route::get('/category/edit', function () {
    return view('admin.category.edit');
});

require __DIR__ . '/auth.php';
use App\Http\Controllers\CategoryController;

// Thay thế các route cũ bằng cụm này:
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::patch('/toggle-status/{id}', [CategoryController::class, 'toggleStatus'])->name('category.toggle-status');
});
