@extends('layouts.admin')

@section('title', 'Tambah Artikel Baru')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Artikel Baru</h1>

    <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Konten</label>
            <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option selected disabled>Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
            <small class="form-text text-muted">Ukuran maksimum: 2MB. Format yang diizinkan: JPG, JPEG, PNG.</small>
        </div>

        <div class="mb-3" id="photo-crop-container" style="display: none;">
            <img id="photo-image" src="#" alt="Photo to crop" style="max-width: 100%;">
            <button type="button" id="crop-button" class="btn btn-primary mt-2">{{ __('Crop') }}</button>
        </div>

        <div class="mb-3" id="photo-preview-container" style="display: none;">
            <img id="photo-preview" src="#" alt="Photo preview" style="max-width: 300px; max-height: 300px;">
            <button type="button" id="edit-photo-button" class="btn btn-secondary mt-2">{{ __('Edit Photo') }}</button>
        </div>

        <input type="hidden" id="cropped-photo" name="cropped_photo">

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
<script>
    CKEDITOR.replace('content');

    document.addEventListener('DOMContentLoaded', function () {
        const photoInput = document.getElementById('photo');
        const photoImage = document.getElementById('photo-image');
        const photoPreview = document.getElementById('photo-preview');
        const photoCropContainer = document.getElementById('photo-crop-container');
        const photoPreviewContainer = document.getElementById('photo-preview-container');
        const croppedPhotoInput = document.getElementById('cropped-photo');
        const cropButton = document.getElementById('crop-button');
        const editPhotoButton = document.getElementById('edit-photo-button');
        let cropper;

        function initCropper(imageUrl) {
            photoImage.src = imageUrl;
            photoCropContainer.style.display = 'block';
            photoPreviewContainer.style.display = 'none';

            if (cropper) {
                cropper.destroy();
            }

            cropper = new Cropper(photoImage, {
                aspectRatio: 1,
                viewMode: 1,
                minCropBoxWidth: 200,
                minCropBoxHeight: 200,
                ready: function() {
                    this.cropper.crop();
                }
            });
        }

        if (photoInput) {
            photoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        initCropper(event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        if (cropButton) {
            cropButton.addEventListener('click', function() {
                if (cropper) {
                    const croppedCanvas = cropper.getCroppedCanvas({
                        width: 300,
                        height: 300
                    });
                    
                    croppedCanvas.toBlob(function(blob) {
                        const fileReader = new FileReader();
                        fileReader.onload = function(e) {
                            croppedPhotoInput.value = e.target.result;
                            photoPreview.src = e.target.result;
                            photoCropContainer.style.display = 'none';
                            photoPreviewContainer.style.display = 'block';
                        };
                        fileReader.readAsDataURL(blob);
                    }, 'image/jpeg', 0.8);
                }
            });
        }

        if (editPhotoButton) {
            editPhotoButton.addEventListener('click', function() {
                initCropper(photoPreview.src);
            });
        }

        // Tambahkan event listener untuk form submission
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                if (croppedPhotoInput.value) {
                    // Jika ada gambar yang di-crop, tidak perlu melakukan apa-apa lagi
                    return;
                }
                if (cropper) {
                    e.preventDefault();
                    cropper.getCroppedCanvas({
                        width: 300,
                        height: 300
                    }).toBlob(function(blob) {
                        const fileReader = new FileReader();
                        fileReader.onload = function(e) {
                            croppedPhotoInput.value = e.target.result;
                            form.submit();
                        };
                        fileReader.readAsDataURL(blob);
                    }, 'image/jpeg', 0.8);
                }
            });
        }
    });
</script>
@endsection