<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    // Form Ambil Antrian Mahasiswa
    public function index()
    {
        if (Auth::user()->role != 'mahasiswa') {
            return redirect()->route('dashboard');
        }

        $jumlahHariIni = Antrian::whereDate('created_at', Carbon::today())->count();
        $nomorAntrian = 'A-' . str_pad($jumlahHariIni + 1, 3, '0', STR_PAD_LEFT);

        return view('antrian.index', compact('nomorAntrian'));
    }
    // Tambahkan fungsi ini untuk halaman kontak
    public function kontak()
    {
        return view('antrian.kontak');
    }

    // Simpan data antrian
    public function store(Request $request)
    { 
        $request->validate([
            'nim' => 'required',
            'prodi' => 'required',
        ]);

        Antrian::create([
            'nomor_antrian' => $request->nomor_antrian,
            'nama'          => Auth::user()->name,
            'nim'           => $request->nim,
            'prodi'         => $request->prodi,
            'layanan'       => 'BAAK',
            'status'        => 'menunggu'
        ]);

        return redirect()->route('mhs.dashboard')
            ->with('success', 'Berhasil! Nomor antrian Anda: ' . $request->nomor_antrian);
    }

    // Dashboard Petugas
    public function dashboard()
    { 
        if (Auth::user()->role != 'petugas') {
            return redirect()->route('mhs.dashboard');
        }

        $antrians = Antrian::whereDate('created_at', Carbon::today())->get();
        return view('antrian.dashboard', compact('antrians'));
    }

    // Dashboard Mahasiswa
    public function dashboardMhs()
    {
        if (Auth::user()->role != 'mahasiswa') {
            return redirect()->route('dashboard');
        }

        $antrians = Antrian::whereDate('created_at', Carbon::today())->get();

        $antrianSaya = Antrian::where('nim', Auth::user()->nim)
            ->whereDate('created_at', Carbon::today())
            ->first();

        return view('antrian.dashboardmhs', compact('antrians', 'antrianSaya'));
    }

    // Update Status Petugas
    public function update(Request $request, $id)
    {
        Antrian::find($id)->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status antrian berhasil diperbarui!');
    }
}
