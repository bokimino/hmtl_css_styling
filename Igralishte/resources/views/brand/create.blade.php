@extends('layouts.form')

@section('content')
<div class="container p-3">
    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col d-flex align-items-center">
                <a href="{{ url()->previous() }}">
                    <x-back-button />
                </a>
                <p class="ml-2 mb-0">Brend</p>
            </div>
            <div class="form-group col col-md-2 col-lg-2 offset-md-4 offset-lg-4">
                <select name="is_active" id="is_active" class="form-control">
                    <option value="disabled">Статус</option>
                    <option value="1">Активен</option>
                    <option value="0">Архивирај</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="tags">Tags:</label>
            <input type="text" name="tags" id="tags" class="form-control" placeholder="Enter tags separated by commas">
        </div>
        <div class="row">
            <div class="col">
                <div class='square-box'>
                    <div class="image-preview" id="preview1">
                        <img src="" alt="Preview Image 1">
                        <button class="remove-image" id="remove1">X</button>
                    </div>
                    <div class='square-content'>
                        <input type="file" name="images[]" class="image-upload" id="upload1">
                        <label for="upload1" class="upload-label">+</label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class='square-box'>
                    <div class="image-preview" id="preview2">
                        <img src="" alt="Preview Image 2">
                        <button class="remove-image" id="remove2">X</button>
                    </div>
                    <div class='square-content'>
                        <input type="file" name="images[]" class="image-upload" id="upload2">
                        <label for="upload2" class="upload-label">+</label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class='square-box'>
                    <div class="image-preview" id="preview3">
                        <img src="" alt="Preview Image 3">
                        <button class="remove-image" id="remove3">X</button>
                    </div>
                    <div class='square-content'>
                        <input type="file" name="images[]" class="image-upload" id="upload3">
                        <label for="upload3" class="upload-label">+</label>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class='square-box'>
                    <div class="image-preview" id="preview4">
                        <img src="" alt="Preview Image 4">
                        <button class="remove-image" id="remove4">X</button>
                    </div>
                    <div class='square-content'>
                        <input type="file" name="images[]" class="image-upload" id="upload4">
                        <label for="upload4" class="upload-label">+</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="brand_category_id">Categories:</label>
            <div>
                <button type="button" id="show-categories-btn" class="form-control text-left">Select a Category</button>
                <select name="brand_category_id[]" id="brand_category_id" class="form-control" multiple required style="display: none;">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <button type="submit" class="btn btn-dark btn-block font-weight-bold">Зачувај</button>
            </div>
            <div class="col-4 align-self-center">
                <a href="{{ url()->previous() }}" class="text-dark">Откажи</a>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showCategoriesBtn = document.getElementById('show-categories-btn');
        const categoriesSelect = document.getElementById('brand_category_id');

        showCategoriesBtn.addEventListener('click', function() {
            categoriesSelect.style.display = 'block';
            showCategoriesBtn.style.display = 'none';
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const showCategoriesBtn = document.getElementById('show-categories-btn');
        const categoriesSelect = document.getElementById('brand_category_ids');

        showCategoriesBtn.addEventListener('click', function() {
            categoriesSelect.style.display = 'block';
            showCategoriesBtn.style.display = 'none';
        });
    });
</script>
@endsection