<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Beranda - Edukasi Pemilahan Sampah')

@section('styles')
<style>
    .jumbotron {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/sampah-background.jpg') }}');
        background-size: cover;
        background-position: center;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }
    .feature-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    .stat-card {
        border: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .info-section {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('content')
<header class="jumbotron" id="beranda">
    <div class="container">
        <h1 class="display-3 font-weight-bold">Pilah Sampahmu, Selamatkan Bumi</h1>
        <p class="lead">Bersama-sama kita bisa menciptakan lingkungan yang lebih bersih dan berkelanjutan</p>
        <a href="#panduan" class="btn btn-primary btn-lg mr-2">Pelajari Cara Memilah</a>
        <a href="#dampak" class="btn btn-outline-light btn-lg">Lihat Dampaknya</a>
    </div>
</header>

<section id="statistik" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Dampak Pemilahan Sampah</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card stat-card text-center">
                    <div class="card-body">
                        <h3 class="card-title text-primary">30%</h3>
                        <p class="card-text">Pengurangan Sampah ke TPA</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card stat-card text-center">
                    <div class="card-body">
                        <h3 class="card-title text-success">50%</h3>
                        <p class="card-text">Peningkatan Daur Ulang</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card stat-card text-center">
                    <div class="card-body">
                        <h3 class="card-title text-info">1000+</h3>
                        <p class="card-text">Komunitas Terlibat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="panduan" class="py-5 info-section">
    <div class="container">
        <h2 class="text-center mb-5">Panduan Pemilahan Sampah</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon text-success">♻️</div>
                        <h5 class="card-title">Sampah Organik</h5>
                        <p class="card-text">Sisa makanan, daun, dan bahan yang dapat terurai secara alami. Dapat diolah menjadi kompos.</p>
                        <ul class="list-unstyled">
                            <li>Sisa makanan</li>
                            <li>Daun dan ranting</li>
                            <li>Kulit buah</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon text-primary">🔋</div>
                        <h5 class="card-title">Sampah Anorganik</h5>
                        <p class="card-text">Plastik, kertas, logam, dan bahan yang sulit terurai secara alami. Bisa didaur ulang.</p>
                        <ul class="list-unstyled">
                            <li>Botol plastik</li>
                            <li>Kardus dan kertas</li>
                            <li>Kaleng aluminium</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon text-danger">☣️</div>
                        <h5 class="card-title">Sampah B3</h5>
                        <p class="card-text">Bahan berbahaya dan beracun yang memerlukan penanganan khusus.</p>
                        <ul class="list-unstyled">
                            <li>Baterai bekas</li>
                            <li>Lampu neon</li>
                            <li>Limbah elektronik</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="dampak" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Dampak Positif Pemilahan Sampah</h2>
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/impact-illustration.jpg') }}" alt="Dampak Pemilahan Sampah" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Lingkungan Lebih Bersih:</strong> Mengurangi pencemaran tanah, air, dan udara.</li>
                    <li class="list-group-item"><strong>Efisiensi Sumber Daya:</strong> Mendaur ulang material yang masih bisa digunakan.</li>
                    <li class="list-group-item"><strong>Mengurangi Emisi Gas Rumah Kaca:</strong> Menurunkan produksi metana dari TPA.</li>
                    <li class="list-group-item"><strong>Menciptakan Lapangan Kerja:</strong> Membuka peluang di industri daur ulang.</li>
                    <li class="list-group-item"><strong>Edukasi Masyarakat:</strong> Meningkatkan kesadaran akan pentingnya kebersihan lingkungan.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="cta" class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="mb-4">Mulai Pilah Sampahmu Hari Ini!</h2>
        <p class="lead mb-4">Setiap tindakan kecil membuat perbedaan besar untuk lingkungan kita.</p>
        <a href="{{ route('guide') }}" class="btn btn-light btn-lg">Pelajari Lebih Lanjut</a>
    </div>
</section>
@endsection