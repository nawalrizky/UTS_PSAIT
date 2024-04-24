<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Perkuliahan;
use Illuminate\Http\Request;

class NilaiMahasiswaController extends Controller
{
    // Menampilkan semua nilai mahasiswa
    public function index()
    {
        // Lakukan join antara tabel perkuliahan dengan tabel mahasiswa dan matakuliah
        $nilaiMahasiswa = Perkuliahan::join('mahasiswa', 'perkuliahan.nim', '=', 'mahasiswa.nim')
                                     ->join('matakuliah', 'perkuliahan.kode_mk', '=', 'matakuliah.kode_mk')
                                     ->select('perkuliahan.*', 'mahasiswa.nama', 'mahasiswa.alamat', 'mahasiswa.tanggal_lahir', 'matakuliah.nama_mk', 'matakuliah.sks')
                                     ->get();
                                     
        return response()->json($nilaiMahasiswa);
    }

    // Menampilkan nilai mahasiswa tertentu berdasarkan nim
    public function show($nim)
    {
        $perkuliahan = Perkuliahan::where('nim', $nim)->get();
        return response()->json($perkuliahan);
    }

    // Memasukkan nilai baru untuk mahasiswa tertentu
    public function store(Request $request)
    {
        $perkuliahan = new Perkuliahan;
        $perkuliahan->nim = $request->nim;
        $perkuliahan->kode_mk = $request->kode_mk;
        $perkuliahan->nilai = $request->nilai;
        $perkuliahan->save();

        return response()->json($perkuliahan, 201);
    }

    // Mengupdate nilai berdasarkan nim dan kode_mk
    public function update(Request $request, $nim, $kode_mk)
    {
        $perkuliahan = Perkuliahan::where('nim', $nim)->where('kode_mk', $kode_mk)->first();
        $perkuliahan->nilai = $request->nilai;
        $perkuliahan->save();

        return response()->json($perkuliahan, 200);
    }

    // Menghapus nilai berdasarkan nim dan kode_mk
    public function destroy($nim, $kode_mk)
    {
        $perkuliahan = Perkuliahan::where('nim', $nim)->where('kode_mk', $kode_mk)->first();
        $perkuliahan->delete();

        return response()->json(null, 204);
    }
}

