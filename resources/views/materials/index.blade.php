@extends('layouts.app')
@section('title', 'Materi Edukasi Sampah')
@section('content')
<div class="container">
    <h1 class="mb-4">Materi Edukasi Sampah</h1>
    
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

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Kategori Materi</h3>
                    <ul class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <li class="list-group-item">
                                <a href="{{ route('materials.category', $category->slug) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card">
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
        </div>
    </div>
</div>
@endsection