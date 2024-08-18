@extends('layouts.app')

@section('title', 'Beranda - Edukasi Pemilahan Sampah')

@section('styles')
<style>
    .jumbotron {
        background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('images/home/bg.png') }}');
        background-size: cover;
        background-position: center;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #ffffff;
    }

    .feature-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #007bff;
    }

    .stat-card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        background-color: #ffffff;
        border-radius: 10px;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .info-section {
        background-color: #f1f1f1;
        padding: 40px 0;
    }

    .btn-primary,
    .btn-outline-light {
        border-radius: 50px;
        font-weight: bold;
        font-size: 1.1rem;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
    }

    .btn-primary:hover,
    .btn-outline-light:hover {
        background-color: #28a745;
        color: #fff;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transform: translateY(-3px);
    }

    .btn-outline-light {
        border: 2px solid #ffffff;
    }

    html {
        scroll-behavior: smooth;
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .card {
        border-radius: 15px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card-title {
        font-weight: bold;
    }

    .card-text {
        color: #555;
    }

    .btn {
        border-radius: 25px;
        padding: 10px 20px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c3nvL8PxbFOTCmqB4K70/Md5TH6wLMPQFbXyLI2X8Iov4sy9mqNijVjQMnX/LItXD0xFBZExbhiVInUyzBYYKg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnH1zQZKn/Nh6O7HAnmOTwo3mfxz2H8O5VvhSK7VEnYbX+zjHTWYGd3PybVbaw0nJmTz5rvMw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.7/countUp.min.js"></script>
@endsection

@section('content')
<header class="jumbotron" id="beranda">
    <div class="container">
        <h1 class="display-3 font-weight-bold animate__animated animate__fadeInDown">Pilah Sampahmu, Selamatkan Bumi</h1>
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">Bersama-sama kita bisa menciptakan lingkungan yang lebih bersih dan berkelanjutan</p>
        <a href="#panduan" class="btn btn-primary btn-lg mr-2 animate__animated animate__fadeInUp animate__delay-2s">Pelajari Cara Memilah</a>
        <a href="#dampak" class="btn btn-outline-light btn-lg animate__animated animate__fadeInUp animate__delay-3s">Lihat Dampaknya</a>
    </div>
</header>

<section id="statistik" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Dampak Pemilahan Sampah</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card stat-card text-center">
                    <div class="card-body">
                        <h3 id="reduced-waste" class="card-title text-primary">30%</h3>
                        <p class="card-text">Pengurangan Sampah ke TPA</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card stat-card text-center">
                    <div class="card-body">
                        <h3 id="increased-recycling" class="card-title text-success">50%</h3>
                        <p class="card-text">Peningkatan Daur Ulang</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card stat-card text-center">
                    <div class="card-body">
                        <h3 id="community-involved" class="card-title text-info">1000+</h3>
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
                        <div class="feature-icon text-success">
                            <i class="fas fa-seedling"></i>
                        </div>
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
                        <div class="feature-icon text-primary">
                            <i class="fas fa-recycle"></i>
                        </div>
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
                        <div class="feature-icon text-danger">
                            <i class="fas fa-biohazard"></i>
                        </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var reducedWaste = new CountUp('reduced-waste', 30);
        var increasedRecycling = new CountUp('increased-recycling', 50);
        var communityInvolved = new CountUp('community-involved', 1000);

        if (!reducedWaste.error) {
            reducedWaste.start();
            increasedRecycling.start();
            communityInvolved.start();
        } else {
            console.error(reducedWaste.error);
        }
    });
</script>
@endsection
