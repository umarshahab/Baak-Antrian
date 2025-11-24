<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Refresh Otomatis setiap 30 detik agar data selalu baru -->
    <meta http-equiv="refresh" content="30"> 
    <title>Admin Dashboard - BAAK</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
        
        /* Sidebar Styling */
        .sidebar {
            background-color: #1e293b; /* Dark Blue Slate */
            min-height: 100vh;
            color: #94a3b8;
        }
        .sidebar .nav-link {
            color: #94a3b8; padding: 12px 20px; border-radius: 8px; margin-bottom: 5px; transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #0f172a; color: white;
        }
        .sidebar-brand { color: white; font-weight: 700; font-size: 1.2rem; padding: 20px; letter-spacing: 0.5px; }

        /* Card Stats Styling */
        .stat-card {
            border: none; border-radius: 12px; background: white; padding: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-5px); }
        .icon-shape {
            width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;
        }
        
        /* Table Styling */
        .table-custom thead th {
            background-color: #f8fafc; color: #64748b; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; border-bottom: 2px solid #e2e8f0;
        }
        .table-custom tbody tr:hover { background-color: #f8fafc; }
        .avatar-initial {
            width: 35px; height: 35px; background-color: #e2e8f0; color: #475569; border-radius: 50%; 
            display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        
        <!-- 1. SIDEBAR (Kiri) -->
        <div class="col-md-3 col-lg-2 sidebar d-none d-md-flex flex-column p-3">
            <div class="sidebar-brand d-flex align-items-center mb-4">
                <i class="bi bi-shield-lock-fill text-primary me-2 fs-4"></i>
                ADMIN BAAK
            </div>
            
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
                    </a>
                </li>
            </ul>

            <!-- Profil Admin Bawah -->
            <div class="mt-auto pt-3 border-top border-secondary">
                <div class="d-flex align-items-center mb-3 text-white px-2">
                    <div class="avatar-initial bg-primary text-white me-2">A</div>
                    <div class="lh-1">
                        <span class="d-block fw-bold small">{{ Auth::user()->name }}</span>
                        <span class="d-block text-muted small" style="font-size: 0.7rem;">Petugas Loket</span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger w-100 btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                </form>
            </div>
        </div>

        <!-- 2. MAIN CONTENT (Kanan) -->
        <div class="col-md-9 col-lg-10 p-4">
            
            <!-- Header Mobile -->
            <div class="d-md-none d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0">Admin Panel</h5>
                <form action="{{ route('logout') }}" method="POST">@csrf <button class="btn btn-sm btn-danger">Keluar</button></form>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-0">Overview Harian</h4>
                    <p class="text-muted small mb-0">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
                <button class="btn btn-light border shadow-sm btn-sm" onclick="window.location.reload()">
                    <i class="bi bi-arrow-clockwise me-1"></i> Refresh Data
                </button>
            </div>

            <!-- STATISTIK CARDS -->
            <div class="row g-3 mb-4">
                <!-- Total Menunggu -->
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center">
                        <div class="icon-shape bg-warning bg-opacity-10 text-warning me-3">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div>
                            <h6 class="text-muted small fw-bold mb-0 text-uppercase">Menunggu</h6>
                            <h3 class="fw-bold mb-0">{{ $antrians->where('status', 'menunggu')->count() }}</h3>
                        </div>
                    </div>
                </div>
                <!-- Sedang Dilayani -->
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center">
                        <div class="icon-shape bg-primary bg-opacity-10 text-primary me-3">
                            <i class="bi bi-mic-fill"></i>
                        </div>
                        <div>
                            <h6 class="text-muted small fw-bold mb-0 text-uppercase">Sedang Dilayani</h6>
                            <h3 class="fw-bold mb-0">{{ $antrians->where('status', 'dilayani')->count() }}</h3>
                        </div>
                    </div>
                </div>
                <!-- Selesai -->
                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center">
                        <div class="icon-shape bg-success bg-opacity-10 text-success me-3">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <div>
                            <h6 class="text-muted small fw-bold mb-0 text-uppercase">Selesai</h6>
                            <h3 class="fw-bold mb-0">{{ $antrians->where('status', 'selesai')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TABEL ANTRIAN -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3 border-bottom border-light d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-list-task me-2 text-primary"></i>Daftar Antrian Masuk</h6>
                    <span class="badge bg-primary rounded-pill">{{ $antrians->count() }} Total</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">No. Antrian</th>
                                <th>Mahasiswa</th>
                                <th>Waktu Ambil</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($antrians as $antrian)
                            <tr>
                                <!-- Kolom Nomor -->
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-light text-primary fw-bold px-3 py-2 border border-primary border-opacity-25">
                                            {{ $antrian->nomor_antrian }}
                                        </div>
                                    </div>
                                </td>

                                <!-- Kolom Mahasiswa -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Inisial Nama sebagai Avatar -->
                                        <div class="avatar-initial me-3 bg-indigo-soft text-indigo">
                                            {{ substr($antrian->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $antrian->nama }}</div>
                                            <div class="text-muted small" style="font-size: 0.8rem;">
                                                {{ $antrian->nim }} <span class="mx-1">•</span> {{ $antrian->prodi }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Kolom Waktu -->
                                <td class="text-muted small">
                                    <i class="bi bi-clock me-1"></i> {{ $antrian->created_at->format('H:i') }} WIB
                                </td>

                                <!-- Kolom Status -->
                                <td>
                                    @if($antrian->status == 'menunggu')
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill border border-warning border-opacity-25">
                                            <span class="spinner-grow spinner-grow-sm me-1" style="width: 6px; height: 6px;" role="status"></span> Menunggu
                                        </span>
                                    @elseif($antrian->status == 'dilayani')
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill border border-primary border-opacity-25">
                                            <i class="bi bi-volume-up me-1"></i> Dipanggil
                                        </span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill border border-success border-opacity-25">
                                            <i class="bi bi-check-circle me-1"></i> Selesai
                                        </span>
                                    @endif
                                </td>

                                <!-- Kolom Aksi -->
                                <td class="text-end pe-4">
                                    @if($antrian->status != 'selesai')
                                        <div class="btn-group shadow-sm" role="group">
                                            <!-- Tombol Panggil -->
                                            <form action="{{ route('update', $antrian->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="dilayani">
                                                <button class="btn btn-outline-primary btn-sm rounded-start fw-bold px-3" title="Panggil ke Loket">
                                                    <i class="bi bi-mic"></i> Panggil
                                                </button>
                                            </form>

                                            <!-- Tombol Selesai -->
                                            <form action="{{ route('update', $antrian->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="selesai">
                                                <button class="btn btn-success btn-sm rounded-end fw-bold px-3" title="Tandai Selesai">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-muted fst-italic small">History</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-50" alt="Empty">
                                    <h6 class="text-muted">Belum ada antrian masuk hari ini.</h6>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>