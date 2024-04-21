<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\UserTransactionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetController;


use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/goBack', [Controller::class, 'goBack'])->name('goBack');

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/userOverview', [DashboardController::class, 'userOverview'])->name('userOverview');
    Route::get('/requestoverview', [DashboardController::class, 'requestoverview'])->name('requestOverview');
    Route::post('/alterUserStatus', [DashboardController::class, 'alterUserStatus'])->name('alterUserStatus');
})->middleware(['auth', 'verified', 'admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('requests')->name('requests.')->group(function () {
    Route::get('/', [RequestController::class, 'index'])->name('index');
    Route::get('/{id}', [RequestController::class, 'show'])->name('show');
    Route::get('/sort/{category}', [RequestController::class, 'sort'])->name('sort');
});



Route::resource('transactions', TransactionController::class)
     ->middleware(['auth', 'verified']);

Route::resource('pets', PetController::class)
    ->middleware(['auth', 'verified']);


Route::prefix('myProfile')->name('userProfile.')->group(function () {
    Route::get('/', [RequestController::class])->name('index');
    Route::get('/me', [RequestController::class, 'user'])->name('user');
    Route::get('/myPets', [RequestController::class, 'pets'])->name('pets');
    Route::get('/myPets/{id}', [RequestController::class, 'pet'])->name('pet');
});

Route::resource('comments', CommentController::class)
   ->middleware(['auth', 'verified']);


Route::resource('userRequests', UserRequestController::class)
    ->middleware(['auth', 'verified']);


Route::prefix('myTransactions')->middleware(['auth', 'verified'])->name('userTransactions.')->group(function () {
    Route::get('/', [UserTransactionController::class, 'index'])->name('index');
    Route::get('/store', [UserTransactionController::class, 'store'])->name('store');
    Route::get('/mySitters', [UserTransactionController::class, 'mySitters'])->name('sitters');
    Route::get('/inMyCare', [UserTransactionController::class, 'inMyCare'])->name('inCare');
});


require __DIR__.'/auth.php';
