<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SubKriteriaController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



Route::controller(KriteriaController::class)->group(function () {
    Route::get('/kriteria', 'index')->name('kriteria.index');
    Route::get('/kriteria/create', 'create')->name('kriteria.create');
    Route::get('/kriteria/{kriteria}/edit', 'edit')->name('kriteria.edit');
    Route::post('/kriteria', 'store')->name('kriteria.store');
    Route::put('/kriteria/{kriteria}', 'update')->name('kriteria.update');
    Route::delete('/kriteria/bulk-delete', 'bulkDelete')->name('kriteria.bulk-delete');
    Route::delete('/kriteria/{kriteria}', 'destroy')->name('kriteria.destroy');
});

Route::controller(SubKriteriaController::class)->group(function () {
    Route::get('/subkriteria', 'index')->name('subkriteria.index');
    Route::get('/subkriteria/create', 'create')->name('subkriteria.create');
    Route::get('/subkriteria/{subKriteria}/edit', 'edit')->name('subkriteria.edit');
    Route::post('/subkriteria', 'store')->name('subkriteria.store');
    Route::put('/subkriteria/{subKriteria}', 'update')->name('subkriteria.update');
    Route::delete('/subkriteria/{subKriteria}', 'destroy')->name('subkriteria.destroy');
});

Route::controller(AlternatifController::class)->group(function () {
    Route::get('/alternatif', 'index')->name('alternatif.index');
    Route::get('/alternatif/create', 'create')->name('alternatif.create');
    Route::get('/alternatif/{alternatif}/edit', 'edit')->name('alternatif.edit');
    Route::post('/alternatif', 'store')->name('alternatif.store');
    Route::put('/alternatif/{alternatif}', 'update')->name('alternatif.update');
    Route::delete('/alternatif/bulk-delete', 'bulkDelete')->name('alternatif.bulk-delete');
    Route::delete('/alternatif/{alternatif}', 'destroy')->name('alternatif.destroy');
});

Route::controller(PenilaianController::class)->group(function () {
    Route::get('/penilaian', 'index')->name('penilaian.index');
    Route::get('/penilaian/create', 'create')->name('penilaian.create');
    Route::get('/penilaian/{alternatif}/edit', 'edit')->name('penilaian.edit');
    Route::post('/penilaian', 'store')->name('penilaian.store');
    Route::put('/penilaian/{alternatif}', 'update')->name('penilaian.update');
    Route::delete('/penilaian/{alternatif}', 'destroy')->name('penilaian.destroy');
});

Route::controller(PerhitunganController::class)->group(function () {
    Route::get('/perhitungan', 'index')->name('perhitungan.index');
    Route::get('/perhitungan/{id}', 'show')
        ->where('id', '[0-9]+')
        ->name('perhitungan.show');

    Route::get('/perhitungan/cetak/{id}', 'cetak')
        ->where('id', '[0-9]+')
        ->name('perhitungan.cetak');

    Route::post('/perhitungan/calculate', 'calculate')->name('perhitungan.calculate');
    Route::delete('/perhitungan/{id}', 'destroy')
        ->where('id', '[0-9]+')
        ->name('perhitungan.destroy');
});
