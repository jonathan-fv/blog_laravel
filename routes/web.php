<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

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
//     return view('welcome');
// });
Route::get('/', [ArticleController::class, 'indexAll'])->name('indexAll');

// Route::get('/create-article', [ArticleController::class, 'create'])->name('create-article');
// Route::post('/create-article', [ArticleController::class, 'store'])->name('store');

// Route::get('/show-article', [ArticleController::class, 'show'])->name('show-article');
// Route::get('/edit-article/{id}', [ArticleController::class, 'edit'])->name('edit-article');

// Route::put('/edit-article/{id}', [ArticleController::class, 'update'])->name('update');

// Route::put('/show-article/{id}', [ArticleController::class, 'publish_at'])->name('publish_at');
// Route::delete('/show-article/{id}', [ArticleController::class, 'destroy']);



// USER DASHBOARD
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'user'])->name('dashboard');

// ADMIN DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/create-article', [ArticleController::class, 'create'])->name('create-article');
    Route::post('/create-article', [ArticleController::class, 'store'])->name('store');

    Route::get('/show-article', [ArticleController::class, 'show'])->name('show-article');
    Route::get('/edit-article/{id}', [ArticleController::class, 'edit'])->name('edit-article');

    Route::put('/edit-article/{id}', [ArticleController::class, 'update'])->name('update');

    Route::put('/show-article/{id}', [ArticleController::class, 'publish_at'])->name('publish_at');
    Route::delete('/show-article/{id}', [ArticleController::class, 'destroy']);

    Route::get('/admin/list-article', [ArticleController::class, 'index'])->name('list-article');
});

require __DIR__.'/auth.php';
