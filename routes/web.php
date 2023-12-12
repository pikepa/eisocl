<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Threads\ManageThreads;
use App\Http\Controllers\ProfileController;
use App\Livewire\Threads\ManageSingleThread;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/threads', ManageThreads::class)->name('threads.index');
Route::get('/threads/{channel}', ManageThreads::class)->name('threads.channel');
Route::get('/threads/{channel}/{thread}', ManageSingleThread::class)->name('threads.single');

Route::get('/dashboard', function () {
    return view('dashboard');
    })->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
