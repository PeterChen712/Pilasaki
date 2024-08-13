@extends('layouts.app')
@section('title', $material->title)
@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('materials.index') }}">Materi</a></li>
            <li class="breadcrumb-item"><a href="{{ route('materials.category', $material->category->slug) }}">{{ $material->category->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $material->title }}</li>
        </ol>
    </nav>

    <h1 class="mb-4">{{ $material->title }}</h1>
    
    <div class="row">
        <div class="col-md-8">
            @if($material->image_url)
                <img src="{{ $material->image_url }}" alt="{{ $material->title }}" class="img-fluid mb-4">
            @endif
            
            <div class="card mb-4">
                <div class="card-body">
                    {!! $material->content !!}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Tentang Materi Ini</h3>
                    <p><strong>Kategori:</strong> {{ $material->category->name }}</p>
                    <p><strong>Terakhir Diperbarui:</strong> {{ $material->updated_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
