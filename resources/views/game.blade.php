<!-- resources/views/game.blade.php -->
@extends('layouts.app')

@section('title', 'Game Pemilahan Sampah')

@section('styles')
<style>
    .game-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #f8f9fa;
    }
    .bins {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .bin {
        width: 150px;
        height: 150px;
        margin: 0 20px;
        background-color: #e9ecef;
        border: 2px dashed #ced4da;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #6c757d;
    }
    .trash-item {
        width: 100px;
        height: 100px;
        margin: 10px;
        background-color: #6c757d;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        cursor: pointer;
        user-select: none;
    }
</style>
@endsection

@section('content')
<div class="game-container">
    <h1 class="display-4">Game Pemilahan Sampah</h1>
    <p class="lead">Geser jenis sampah ke tong sampah yang sesuai</p>
    <div class="trash-items">
        <div class="trash-item" draggable="true" data-type="organic">Sisa Makanan</div>
        <div class="trash-item" draggable="true" data-type="inorganic">Botol Plastik</div>
        <div class="trash-item" draggable="true" data-type="b3">Baterai</div>
    </div>
    <div class="bins">
        <div class="bin" data-type="organic">Organik</div>
        <div class="bin" data-type="inorganic">Anorganik</div>
        <div class="bin" data-type="b3">B3</div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const trashItems = document.querySelectorAll('.trash-item');
        const bins = document.querySelectorAll('.bin');

        trashItems.forEach(item => {
            item.addEventListener('dragstart', handleDragStart);
        });

        bins.forEach(bin => {
            bin.addEventListener('dragover', handleDragOver);
            bin.addEventListener('drop', handleDrop);
        });

        function handleDragStart(e) {
            e.dataTransfer.setData('text/plain', e.target.dataset.type);
            e.dataTransfer.setData('text/html', e.target.outerHTML);
            e.target.classList.add('dragging');
        }

        function handleDragOver(e) {
            e.preventDefault();
        }

        function handleDrop(e) {
            e.preventDefault();
            const itemType = e.dataTransfer.getData('text/plain');
            const binType = e.target.dataset.type;

            if (itemType === binType) {
                e.target.innerHTML += e.dataTransfer.getData('text/html');
                const draggedItem = document.querySelector('.dragging');
                draggedItem.parentNode.removeChild(draggedItem);
            } else {
                alert('Salah tempat! Coba lagi.');
            }
        }
    });
</script>
@endsection
