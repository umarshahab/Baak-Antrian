<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    // 1. Halaman Depan (Form Mahasiswa)
    public function index()
    {
        // Jika Petugas login, lempar ke dashboard
        if (Auth::user()->role == 'petugas') {
            return redirect()->route('dashboard');
        }

        // Generate Nomor Antrian (A-001, dst)
        $jumlahHariIni = Antrian::whereDate('created_at', Carbon::today())->count();
        $nomorAntrian = 'A-' . str_pad($jumlahHariIni + 1, 3, '0', STR_PAD_LEFT);

        return view('antrian.index', compact('nomorAntrian'));
    }

    // 2. Proses Simpan Data (Nama, NIM, Prodi)
    public function store(Request $request)
    {
        // Validasi wajib diisi
        $request->validate([
            'nim' => 'required',
            'prodi' => 'required',
        ]);

        Antrian::create([
            'nomor_antrian' => $request->nomor_antrian,
            'nama'          => Auth::user()->name, // Nama ambil otomatis dari akun login
            'nim'           => $request->nim,
            'prodi'         => $request->prodi,
            'layanan'       => 'BAAK',
            'status'        => 'menunggu'
        ]);

        return redirect()->back()->with('success', 'Berhasil! Nomor antrian Anda: ' . $request->nomor_antrian);
    }

    // 3. Dashboard Petugas
    public function dashboard()
    {
        // Proteksi: Mahasiswa tidak boleh masuk sini
        if (Auth::user()->role != 'petugas') {
            return redirect()->route('home');
        }

        $antrians = Antrian::whereDate('created_at', Carbon::today())->get();
        return view('antrian.dashboard', compact('antrians'));
    }

    // 4. Update Status (Panggil/Selesai)
    public function update(Request $request, $id)
    {
        Antrian::find($id)->update(['status' => $request->status]);
        return redirect()->back();
    }
}