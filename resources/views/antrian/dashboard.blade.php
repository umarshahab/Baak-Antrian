<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30">
    <title>Dashboard Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d6d6d6; /* background lebih gelap */
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Dashboard Petugas BAAK</a> 
            <div class="d-flex">
                <span class="navbar-text text-white me-3">
                    Halo, {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="container flex-grow-1 my-4">

        {{-- Card Daftar Antrian --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Antrian Hari Ini</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No Antrian</th>
                                <th>Mahasiswa</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Aksi Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($antrians as $antrian)
                            <tr>
                                <td class="fw-bold text-primary">{{ $antrian->nomor_antrian }}</td>
                                <td class="text-start">
                                    {{ $antrian->nama }}<br>
                                    <small class="text-muted">NIM: {{ $antrian->nim }}</small><br>
                                    <span class="badge bg-info text-dark">{{ $antrian->prodi }}</span>
                                </td>
                                <td>{{ $antrian->created_at->format('H:i') }} WIB</td>
                                <td>
                                    @if($antrian->status == 'menunggu')
                                        <span class="badge bg-secondary">Menunggu</span>
                                    @elseif($antrian->status == 'dilayani')
                                        <span class="badge bg-warning text-dark">Sedang Dilayani</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if($antrian->status != 'selesai')
                                        <form action="{{ route('update', $antrian->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="dilayani">
                                            <button class="btn btn-primary btn-sm">Panggil</button>
                                        </form>

                                        <form action="{{ route('update', $antrian->id) }}" method="POST" class="d-inline ms-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="selesai">
                                            <button class="btn btn-success btn-sm">Selesai</button>
                                        </form>
                                    @else
                                        <span class="text-muted fst-italic">Sudah Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-5 text-muted">Belum ada antrian hari ini</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    {{-- Footer --}}
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <small>© {{ date('Y') }} BAAK Politeknik. All Rights Reserved.</small>
    </footer>

</body>
</html>
