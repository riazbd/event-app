<?php

use App\Http\Controllers\EventReminderController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [EventReminderController::class, 'index']);
Route::resource('events', EventReminderController::class)->except(['show']);
Route::post('events/import', [EventReminderController::class, 'import'])->name('events.import');
Route::get('events/export', [EventReminderController::class, 'export'])->name('events.export');
Route::post('events/{event}/complete', [EventReminderController::class, 'markAsComplete'])->name('events.complete');
