<!DOCTYPE html>
<html lang="id">
<head>
    <title>Ambil Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Halo, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST"> @csrf <button class="btn btn-danger btn-sm">Logout</button> </form>
        </div>
    </nav>

    <div class="container col-md-6">
        <div class="card shadow">
            <div class="card-header bg-white text-center">
                <h4>Form Ambil Antrian</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <h1 class="text-center display-4 text-primary fw-bold">{{ $nomorAntrian }}</h1>

                <form action="{{ route('simpan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="nomor_antrian" value="{{ $nomorAntrian }}">

                    <div class="mb-3">
                        <label>Nama Mahasiswa</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label>NIM</label>
                        <input type="number" name="nim" class="form-control" placeholder="Contoh: 210001" required>
                    </div>

                    <div class="mb-3">
                        <label>Program Studi</label>
                        <select name="prodi" class="form-select" required>
                            <option value="">-- Pilih Prodi --</option>
                            <option value="Informatika">Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Akuntansi">Akuntansi</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-lg">AMBIL NOMOR</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>