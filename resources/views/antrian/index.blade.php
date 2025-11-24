<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Layanan BAAK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
        }

        /* --- 1. HEADER STYLE (Mirip PCR) --- */
        .top-header {
            background: #fff;
            padding: 15px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .campus-logo {
            font-weight: 800;
            font-size: 1.5rem;
            color: #002B5C;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .campus-sub {
            font-size: 0.8rem;
            color: #666;
            font-weight: 400;
            letter-spacing: 0;
        }

        /* Navbar Biru */
        .main-navbar {
            background-color: #00ADEF;
            /* Warna Biru Khas PCR */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.9rem;
            padding: 15px 20px !important;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* --- 2. HERO SECTION (Background Gedung) --- */
        .hero-section {
            background: linear-gradient(rgba(0, 43, 92, 0.8), rgba(0, 43, 92, 0.7)), url('https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 60px 0;
            margin-bottom: -50px;
            /* Supaya kartu menumpuk ke atas */
        }

        /* --- 3. CARDS STYLE --- */
        .floating-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background: white;
            overflow: hidden;
        }

        .card-header-blue {
            background-color: #002B5C;
            color: white;
            padding: 15px;
            font-weight: 600;
        }

        .number-display {
            font-size: 4rem;
            font-weight: 800;
            color: #00ADEF;
            line-height: 1;
        }

        .queue-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6c757d;
        }

        /* Jam Digital */
        .live-clock {
            background: rgba(255, 255, 255, 0.1);
            padding: 5px 15px;
            border-radius: 20px;
            font-family: monospace;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>

    <header class="top-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="bi bi-mortarboard-fill fs-1 me-3 text-primary"></i>
                <div class="campus-logo lh-1">
                    POLITEKNIK BAAK<br>
                    <span class="campus-sub">Empowers You to Global Competition</span>
                </div>
            </div>
            <div class="d-none d-md-block text-end">
                <small class="text-muted d-block">Selamat Datang,</small>
                <span class="fw-bold text-dark">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg main-navbar sticky-top">
        <div class="container">
            <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-2"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                    <li class="nav-item">
                        <!-- Ganti tanda # dengan route('kontak') -->
                        <a class="nav-link" href="{{ route('kontak') }}">Kontak</a>
                    </li>
                </ul>
                <div class="text-white d-flex align-items-center">
                    <i class="bi bi-clock me-2"></i>
                    <span id="jam" class="live-clock">--:--:--</span>
                </div>
                <div class="d-lg-none mt-3">
                    <form action="{{ route('logout') }}" method="POST">@csrf <button class="btn btn-light w-100 text-primary fw-bold">Logout</button></form>
                </div>
            </div>
            <div class="d-none d-lg-block ms-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-light btn-sm px-3 rounded-pill">LOGOUT</button>
                </form>
            </div>
        </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container pb-5">
            <h1 class="fw-bold display-5 mb-2">BAGIAN ADMINISTRASI AKADEMIK</h1>
            <p class="lead mb-4 opacity-75">Layanan Akademik Terpadu Politeknik (Senin - Jumat, 08.00 - 16.00 WIB)</p>
        </div>
    </section>

    <div class="container position-relative" style="margin-top: -60px; z-index: 10;">
        <div class="row g-4">

            <div class="col-lg-4">
                <div class="floating-card h-100 text-center p-4">
                    <div class="mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold">
                            ANTRIAN SAAT INI
                        </span>
                    </div>
                    <div class="number-display mb-2">{{ $nomorAntrian }}</div>

                    <p class="text-muted small mb-4">Nomor ini akan dipanggil berikutnya.</p>

                    <hr>

                    <div class="text-start mt-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-calendar-week me-2 text-primary"></i>Jadwal Pelayanan</h6>
                        <ul class="list-unstyled small text-muted">
                            <li class="mb-2 d-flex justify-content-between">
                                <span>Senin - Kamis</span>
                                <span class="fw-bold text-dark">08:00 - 16:00</span>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span>Jumat</span>
                                <span class="fw-bold text-dark">08:00 - 16:30</span>
                            </li>
                            <li class="d-flex justify-content-between text-danger">
                                <span>Sabtu - Minggu</span>
                                <span class="fw-bold">TUTUP</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="floating-card h-100">
                    <div class="card-header-blue d-flex align-items-center">
                        <i class="bi bi-pencil-square fs-4 me-2"></i> Form Ambil Antrian
                    </div>
                    <div class="p-4 p-md-5">

                        @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center shadow-sm border-0 mb-4">
                            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                            <div>
                                <strong>Berhasil!</strong> {{ session('success') }}
                            </div>
                        </div>
                        @endif

                        <form action="{{ route('simpan') }}" method="POST">
                            @csrf
                            <input type="hidden" name="nomor_antrian" value="{{ $nomorAntrian }}">

                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="fw-bold small text-muted mb-1">NAMA MAHASISWA</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control bg-light" value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-bold small text-muted mb-1">NIM</label>
                                    <input type="number" name="nim" class="form-control py-2" placeholder="Masukkan NIM..." required>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-bold small text-muted mb-1">PROGRAM STUDI</label>
                                    <select name="prodi" class="form-select py-2" required>
                                        <option value="">-- Pilih Prodi --</option>
                                        <option value="Teknik Informatika">Teknik Informatika</option>
                                        <option value="Sistem Informasi">Sistem Informasi</option>
                                        <option value="Teknik Komputer">Teknik Komputer</option>
                                        <option value="Akuntansi">Akuntansi</option>
                                    </select>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold text-uppercase shadow-sm" style="background-color: #00ADEF; border: none;">
                                        <i class="bi bi-ticket-fill me-2"></i> Ambil Nomor Antrian
                                    </button>
                                    <p class="text-center text-muted small mt-2">
                                        *Pastikan data sesuai dengan KTM Anda.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="text-center py-4 mt-5 text-muted small">
        &copy; 2024 Politeknik BAAK System. All Rights Reserved.
    </footer>

    <script>
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                hour12: false
            });
            document.getElementById('jam').textContent = timeString + ' WIB';
        }
        setInterval(updateClock, 1000);
        updateClock(); // Jalankan langsung
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>