<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak BAAK - Politeknik Caltex Riau</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f4f6f9; }
        
        /* Header & Navbar Style (Konsisten dengan Dashboard) */
        .top-header { background: #fff; padding: 15px 0; border-bottom: 1px solid #e0e0e0; }
        .campus-logo { font-weight: 800; font-size: 1.5rem; color: #002B5C; text-transform: uppercase; letter-spacing: 1px; }
        .campus-sub { font-size: 0.8rem; color: #666; font-weight: 400; }
        .main-navbar { background-color: #00ADEF; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .nav-link { color: white !important; font-weight: 500; text-transform: uppercase; font-size: 0.9rem; padding: 15px 20px !important; }
        .nav-link:hover { background-color: rgba(255,255,255,0.2); }

        /* Kartu Kontak Style */
        .contact-card {
            border: none; border-radius: 12px; background: white; padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05); text-align: center; height: 100%; transition: transform 0.3s;
        }
        .contact-card:hover { transform: translateY(-5px); }
        .icon-circle {
            width: 70px; height: 70px; background: #e3f2fd; color: #00ADEF; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 20px;
        }
        
        /* Map Container Style */
        .map-container {
            border-radius: 12px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.05); border: 4px solid white;
        }
    </style>
</head>
<body>

<!-- HEADER LOGO -->
<header class="top-header">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <i class="bi bi-mortarboard-fill fs-1 me-3 text-primary"></i>
            <div class="campus-logo lh-1">
                POLITEKNIK CALTEX RIAU<br>
                <span class="campus-sub">Bagian Administrasi Akademik & Kemahasiswaan</span>
            </div>
        </div>
        <div class="d-none d-md-block text-end">
             <a href="{{ route('mhs.dashboard') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</header>

<!-- NAVBAR MENU -->
<nav class="navbar navbar-expand-lg main-navbar sticky-top">
    <div class="container">
        <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list fs-2"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('mhs.dashboard') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Kontak</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- KONTEN UTAMA -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #002B5C;">Pusat Bantuan BAAK</h2>
        <p class="text-muted">Hubungi kami melalui saluran berikut jika Anda mengalami kendala akademik.</p>
    </div>

    <div class="row g-4 mb-5">
        <!-- Kartu 1: WhatsApp -->
        <div class="col-md-4">
            <div class="contact-card">
                <div class="icon-circle bg-success bg-opacity-10 text-success">
                    <i class="bi bi-whatsapp"></i>
                </div>
                <h5 class="fw-bold mb-2">WhatsApp BAAK</h5>
                <p class="text-muted small">Chat Only (08:00 - 16:00)</p>
                <a href="https://wa.me/628117580101" class="btn btn-success rounded-pill px-4 fw-bold">
                    Chat Sekarang
                </a>
            </div>
        </div>

        <!-- Kartu 2: Email -->
        <div class="col-md-4">
            <div class="contact-card">
                <div class="icon-circle bg-danger bg-opacity-10 text-danger">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                <h5 class="fw-bold mb-2">Email Akademik</h5>
                <p class="text-muted small">Surat & Transkrip Nilai</p>
                <a href="mailto:baak@pcr.ac.id" class="btn btn-danger rounded-pill px-4 fw-bold">
                    baak@pcr.ac.id
                </a>
            </div>
        </div>

        <!-- Kartu 3: Telepon -->
        <div class="col-md-4">
            <div class="contact-card">
                <div class="icon-circle">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                <h5 class="fw-bold mb-2">Telepon Kantor</h5>
                <p class="text-muted small">Sentral Telepon PCR</p>
                <a href="tel:0761554224" class="btn btn-primary rounded-pill px-4 fw-bold" style="background-color: #00ADEF; border:none;">
                    (0761) 554224
                </a>
            </div>
        </div>
    </div>

    <!-- Peta Lokasi PCR -->
    <div class="row">
        <div class="col-12">
            <div class="map-container bg-white p-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-geo-alt-fill text-danger fs-3 me-2"></i>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">Lokasi Kampus</h5>
                        <small class="text-muted">Jl. Umban Sari (Patin) No. 1, Rumbai, Pekanbaru, Riau 28265</small>
                    </div>
                </div>
                
                <!-- Embed Google Maps Asli PCR -->
                <div class="ratio ratio-21x9">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.692620703813!2d101.42371231475354!3d0.5287349996130453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ac0677567793%3A0xe5435967732d8478!2sPoliteknik%20Caltex%20Riau!5e0!3m2!1sid!2sid!4v1709623890000!5m2!1sid!2sid" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                
                <div class="mt-3 text-center">
                    <a href="https://maps.app.goo.gl/PCRLocationLink" target="_blank" class="btn btn-light btn-sm text-primary fw-bold">
                        <i class="bi bi-box-arrow-up-right"></i> Buka di Google Maps App
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center py-4 mt-5 text-muted small bg-white border-top">
    &copy; 2024 Politeknik Caltex Riau - BAAK System. All Rights Reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>