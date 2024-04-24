<?php
use App\Http\Controllers\NilaiMahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/nilai-mahasiswa', [NilaiMahasiswaController::class, 'index']);
Route::get('/api/nilai-mahasiswa/{nim}', [NilaiMahasiswaController::class, 'show']);
Route::post('/api/nilai-mahasiswa', [NilaiMahasiswaController::class, 'store']);
Route::put('/api/nilai-mahasiswa/{nim}/{kode_mk}', [NilaiMahasiswaController::class, 'update']);
Route::delete('/api/nilai-mahasiswa/{nim}/{kode_mk}', [NilaiMahasiswaController::class, 'destroy']);
