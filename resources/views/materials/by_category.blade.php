@extends('layouts.app')
@section('title', 'Materi Kategori: ' . $category->name)
@section('content')
<div class="container">
    <h1 class="mb-4">Materi Kategori: {{ $category->name }}</h1>
    
    <div class="row">
        <div class="col-md-8">
            @foreach($materials as $material)
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">{{ $material->title }}</h2>
                        <p class="card-text">{{ $material->description }}</p>
                        <a href="{{ route('materials.show', $material->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            @endforeach

            {{ $materials->links() }}
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Tentang Kategori</h3>
                    <p>{{ $category->description }}</p>
                    <a href="{{ route('materials.index') }}" class="btn btn-secondary">Kembali ke Semua Materi</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection