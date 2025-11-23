<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e0e0e0; 
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Dashboard Mahasiswa BAAK</a>
            
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

    {{-- Main Content --}}
    <main class="container my-4 flex-grow-1">

        {{-- Kartu Info Antrian --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                Informasi Antrian Hari Ini
            </div>
            <div class="card-body">
                <p>Tanggal: {{ now()->format('d M Y') }}</p>

                @if($antrianSaya)
                    <div class="p-3 border rounded bg-light">
                        <p class="fw-bold mb-1">Nomor Antrian Kamu: {{ $antrianSaya->nomor_antrian }}</p>
                        <p>Status: 
                            @if($antrianSaya->status == 'menunggu')
                                <span class="badge bg-secondary">Menunggu</span>
                            @elseif($antrianSaya->status == 'dipanggil')
                                <span class="badge bg-warning text-dark">Dipanggil</span>
                            @elseif($antrianSaya->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </p>
                    </div>
                @else
                    <a href="{{ route('ambil.antrian') }}" class="btn btn-primary mt-2">Ambil Antrian</a>
                @endif
            </div>
        </div>

        {{-- Daftar Antrian --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                Daftar Antrian Hari Ini
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nomor Antrian</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($antrians as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-bold text-primary">{{ $item->nomor_antrian }}</td>
                                    <td class="text-start">{{ $item->nama }}</td>
                                    <td>{{ $item->prodi }}</td>
                                    <td>
                                        @if($item->status == 'menunggu')
                                            <span class="badge bg-secondary">Menunggu</span>
                                        @elseif($item->status == 'dipanggil')
                                            <span class="badge bg-warning text-dark">Dipanggil</span>
                                        @elseif($item->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-5 text-muted">
                                        Belum ada antrian hari ini
                                    </td>
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
