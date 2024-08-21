@extends('layouts.admin')

@section('title', 'Create Material Category')

@section('content')
<h1>Buat Kategori Artikel</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Buat Kategori') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.material-categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    
                        {{-- Form Edit Nama --}}
                        <div class="form-group">
                            <label for="name">{{ __('Nama') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Form slug --}}
                        <div class="form-group">
                            <label for="slug">{{ __('Slug') }}</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" required>
                            @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Form Edit Deskrpsi --}}
                        <div class="form-group">
                            <label for="description">{{ __('Deskripsi') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Form Edit Avatar --}}
                        <div class="form-group">
                            <label for="avatar">{{ __('Avatar') }}</label>
                            <input type="file" class="form-control-file @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*">
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group" id="avatar-preview-container" style="display: none;">
                            <img id="avatar-preview" src="#" alt="Avatar preview" style="max-width: 300px; max-height: 300px;">
                            <button type="button" id="edit-avatar-button" class="btn btn-secondary mt-2">{{ __('Edit Avatar') }}</button>
                        </div>
                    
                        <div class="form-group" id="avatar-crop-container" style="display: none;">
                            <img id="avatar-image" src="#" alt="Avatar to crop" style="max-width: 100%;">
                            <button type="button" id="crop-button" class="btn btn-primary mt-2">{{ __('Crop') }}</button>
                        </div>
                    
                        <input type="hidden" id="cropped-avatar" name="cropped_avatar">

                        <button type="submit" class="btn btn-primary">{{ __('Buat Kategori') }}</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Crop Image Modal -->
<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="cropImagePopLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropImagePopLabel">Crop Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="sample_image" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const avatarInput = document.getElementById('avatar');
    const avatarImage = document.getElementById('avatar-image');
    const avatarPreview = document.getElementById('avatar-preview');
    const avatarCropContainer = document.getElementById('avatar-crop-container');
    const avatarPreviewContainer = document.getElementById('avatar-preview-container');
    const croppedAvatarInput = document.getElementById('cropped-avatar');
    const cropButton = document.getElementById('crop-button');
    const editAvatarButton = document.getElementById('edit-avatar-button');
    let cropper;

    function initCropper(imageUrl) {
        avatarImage.src = imageUrl;
        avatarCropContainer.style.display = 'block';
        avatarPreviewContainer.style.display = 'none';

        if (cropper) {
            cropper.destroy();
        }

        cropper = new Cropper(avatarImage, {
            aspectRatio: 1,
            viewMode: 1,
            minCropBoxWidth: 200,
            minCropBoxHeight: 200,
            ready: function() {
                this.cropper.crop();
            }
        });
    }

    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
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
                        croppedAvatarInput.value = e.target.result;
                        avatarPreview.src = e.target.result;
                        avatarCropContainer.style.display = 'none';
                        avatarPreviewContainer.style.display = 'block';
                    };
                    fileReader.readAsDataURL(blob);
                }, 'image/jpeg', 0.8);
            }
        });
    }

    if (editAvatarButton) {
        editAvatarButton.addEventListener('click', function() {
            initCropper(avatarPreview.src);
        });
    }

    // Tambahkan event listener untuk form submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (croppedAvatarInput.value) {
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
                        croppedAvatarInput.value = e.target.result;
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