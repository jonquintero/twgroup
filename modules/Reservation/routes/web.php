<?php

use Illuminate\Support\Facades\Route;
use Modules\Reservation\Http\Controllers\AdminReservationController;
use Modules\Reservation\Http\Controllers\ReservationController;

Route::middleware(['auth', 'role:Cliente'])->group(function () {
    Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
});

Route::middleware(['auth', 'role:Administrador'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::patch('reservations/{reservation}', [AdminReservationController::class, 'update'])->name('reservations.update');
});

