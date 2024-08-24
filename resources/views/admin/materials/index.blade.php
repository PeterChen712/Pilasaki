@extends('layouts.admin')

@section('title', 'Kelola Artikel')

@section('content')
<div class="container">
    <h1 class="mb-4">Kelola Artikel</h1>
    <a href="{{ route('admin.materials.create') }}" class="btn btn-primary mb-3">Tambah Artikel Baru</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
            <tr>
                <td>{{ $material->id }}</td>
                <td>{{ $material->title }}</td>
                <td>{{ $material->category->name }}</td>
                <td>
                    <a href="{{ route('admin.materials.edit', $material) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.materials.destroy', $material) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus materi ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $materials->links() }}
</div>
@endsection