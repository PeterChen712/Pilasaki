@extends('layouts.admin')

@section('title', 'Material Categories')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Material Categories</h1>
        <a href="{{ route('admin.material-categories.create') }}" class="btn btn-primary">Add New Category</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        @if($category->photo)
                            <img src="{{ asset('storage/' . $category->photo) }}" alt="{{ $category->name }}" width="50">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.material-categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.material-categories.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
