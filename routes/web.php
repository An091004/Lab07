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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Xem danh sách & chi tiết: công khai
Route::resource('articles', ArticleController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Các thao tác yêu cầu đăng nhập (có ràng buộc quyền)
    Route::get('/articles/create', [ArticleController::class, 'create'])
        ->name('articles.create')
        ->middleware('can:create,App\\Models\\Article');

    Route::post('/articles', [ArticleController::class, 'store'])
        ->name('articles.store')
        ->middleware('can:create,App\\Models\\Article');

    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])
        ->name('articles.edit')
        ->middleware('can:update,article');

    Route::put('/articles/{article}', [ArticleController::class, 'update'])
        ->name('articles.update')
        ->middleware('can:update,article');

    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])
        ->name('articles.destroy')
        ->middleware('can:delete,article');

    // Khu vực admin
    Route::prefix('admin')
        ->middleware(['admin'])
        ->group(function () {
            Route::resource('articles', ArticleController::class)
                ->names('admin.articles');
        });
});

require __DIR__.'/auth.php';
