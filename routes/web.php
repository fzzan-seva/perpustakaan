<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check() && auth()->user()->hasRole('siswa')) {
        return redirect()->route('catalog.index');
    }
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('borrowings/history', fn () => view('borrowings.history'))->name('borrowings.history');
    Route::post('borrowings/request', [BorrowingController::class, 'requestBorrow'])->name('borrowings.request');
    Route::patch('borrowings/{borrowing}/confirm', [BorrowingController::class, 'confirm'])->name('borrowings.confirm');
    Route::patch('borrowings/{borrowing}/reject', [BorrowingController::class, 'reject'])->name('borrowings.reject');
    Route::resource('borrowings', BorrowingController::class);
    Route::resource('returns', ReturnController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('publishers', PublisherController::class);
    Route::resource('racks', RackController::class);
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);

    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');

    Route::get('catalog', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('catalog/{book}', [CatalogController::class, 'show'])->name('catalog.show');
});

require __DIR__.'/auth.php';
