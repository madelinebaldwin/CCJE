<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpenseController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('events', EventController::class);
Route::get('/events/{event}/report', [EventController::class, 'report'])->name('events.report');

Route::get('/events/{event}/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
Route::post('/events/{event}/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
