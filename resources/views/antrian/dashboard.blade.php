<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30">
    <title>Dashboard Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">👮‍♂️ Dashboard Petugas BAAK</a>
            
            <div class="d-flex">
                <span class="navbar-text text-white me-3">
                    Halo, {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm" type="submit">Logout 🚪</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📋 Daftar Antrian Hari Ini</h5>
                <small>Auto-refresh setiap 30 detik</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No Antrian</th>
                                <th>Mahasiswa</th> <th>Waktu</th>
                                <th>Status</th>
                                <th>Aksi Petugas</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @forelse($antrians as $antrian)
                            <tr>
                                <td class="text-center">
                                    <span class="display-6 fw-bold text-primary">{{ $antrian->nomor_antrian }}</span>
                                </td>

                                <td>
                                    <div class="fw-bold">{{ $antrian->nama }}</div>
                                    <small class="text-muted">NIM: {{ $antrian->nim }}</small><br>
                                    <span class="badge bg-info text-dark">{{ $antrian->prodi }}</span>
                                </td>

                                <td class="text-center">{{ $antrian->created_at->format('H:i') }} WIB</td>

                                <td class="text-center">
                                    @if($antrian->status == 'menunggu')
                                        <span class="badge bg-secondary rounded-pill px-3">Menunggu</span>
                                    @elseif($antrian->status == 'dilayani')
                                        <span class="badge bg-warning text-dark rounded-pill px-3 fw-bold">Sedang Dilayani...</span>
                                    @else
                                        <span class="badge bg-success rounded-pill px-3">Selesai</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($antrian->status != 'selesai')
                                        <form action="{{ route('update', $antrian->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="dilayani">
                                            <button class="btn btn-primary btn-sm">📢 Panggil</button>
                                        </form>

                                        <form action="{{ route('update', $antrian->id) }}" method="POST" class="d-inline ms-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="selesai">
                                            <button class="btn btn-success btn-sm">✅ Selesai</button>
                                        </form>
                                    @else
                                        <span class="text-muted fst-italic">Sudah Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <h4>Belum ada antrian hari ini 😴</h4>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>