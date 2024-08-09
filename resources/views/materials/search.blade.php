@extends('layouts.app')
@section('title', 'Hasil Pencarian: ' . $query)
@section('content')
<div class="container">
    <h1 class="mb-4">Hasil Pencarian: {{ $query }}</h1>
    
    <div class="row">
        <div class="col-md-8">
            @if($materials->count() > 0)
                @foreach($materials as $material)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title">{{ $material->title }}</h2>
                            <p class="card-text">{{ $material->description }}</p>
                            <a href="{{ route('materials.show', $material->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                @endforeach

                {{ $materials->appends(['query' => $query])->links() }}
            @else
                <div class="alert alert-info">
                    Tidak ada hasil yang ditemukan untuk pencarian "{{ $query }}".
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Cari Lagi</h3>
                    <form action="{{ route('materials.search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="query" placeholder="Masukkan kata kunci..." value="{{ $query }}">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection