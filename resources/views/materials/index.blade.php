@extends('layouts.app')

@section('title', 'Materi Edukasi Sampah')

@section('content')
<div class="container">
    <h1 class="mb-4">Materi Edukasi Sampah</h1>
    
    <div class="row">
        <!-- Card View untuk Kategori Materi -->
        <div class="col-md-8">
            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="{{ $category->image_url }}" class="card-img-top" alt="{{ $category->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                            <a href="{{ route('materials.category', $category->slug) }}" class="btn btn-primary">Lihat Materi</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Sidebar dengan fitur Search dan Materi Terakhir Dilihat -->
        <div class="col-md-4">
            <!-- Search Box -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Cari Materi</h3>
                    <form action="{{ route('materials.search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="query" placeholder="Masukkan kata kunci...">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Materi Terakhir Dilihat -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Materi Terakhir Dilihat</h3>
                    @if($recentMaterials->isEmpty())
                        <p class="text-muted">Belum ada materi yang dilihat.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($recentMaterials as $material)
                            <li class="list-group-item">
                                <a href="{{ route('materials.show', $material->slug) }}">
                                    {{ $material->title }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- List Materi -->
    <div class="row">
        <div class="col-md-8">
            @foreach($materials as $material)
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">{{ $material->title }}</h2>
                        <p class="card-text">{{ $material->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('materials.show', $material->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
                            <small class="text-muted">Kategori: {{ $material->category->name }}</small>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $materials->links() }}
        </div>
    </div>
</div>
@endsection
