@extends('layouts.admin')

@section('title', 'Edit Material Category')

@section('content')
<h1>Edit Material Category</h1>

<form action="{{ route('admin.material-categories.update', $materialCategory->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $materialCategory->name) }}">
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $materialCategory->slug) }}">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $materialCategory->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="photo" class="form-label">Photo</label>
        <input type="file" class="form-control-file @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
        @error('photo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group" id="photo-preview-container" style="display: none;">
        <img id="photo-preview" src="{{ old('cropped_photo', asset('storage/' . $materialCategory->photo)) }}" alt="Photo preview" style="max-width: 300px; max-height: 300px;">
        <button type="button" id="edit-photo-button" class="btn btn-secondary mt-2">Edit Photo</button>
    </div>

    <div class="form-group" id="photo-crop-container" style="display: none;">
        <img id="photo-image" src="#" alt="Photo to crop" style="max-width: 100%;">
        <button type="button" id="crop-button" class="btn btn-primary mt-2">Crop</button>
    </div>

    <input type="hidden" id="cropped-photo" name="cropped_photo" value="{{ old('cropped_photo') }}">

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
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
