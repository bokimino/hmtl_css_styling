@extends('layouts.form')

@section('content')


<div class="container p-3">

    <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col d-flex align-items-center">
                <a href="{{ url()->previous() }}">
                    <x-back-button />
                </a>
                <p class="ml-2 mb-0">Попуст/промо код</p>
            </div>
            <div class="form-group col col-md-2 col-lg-2 offset-md-4 offset-lg-4">
                <select name="is_active" id="is_active" class="form-control">
                    <option value="1" {{ $brand->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$brand->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>


        <!-- Brand Name -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $brand->name }}" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control">{{ $brand->description }}</textarea>
        </div>
        <!-- Brand Tags -->
        <div class="form-group">
            <label for="tags">Tags:</label>
            <input type="text" name="tags" id="tags" class="form-control" placeholder="Enter tags separated by commas" value="{{ implode(', ', $brand->tags->pluck('name')->toArray()) }}">
        </div>


        <!-- Brand Category -->

        <div class="row">
            @foreach($brand->images->take(4) as $index => $image)
            <div class="col">
                <div class="square-box">
                    <div class="image-preview-edit" id="preview{{ $index + 1 }}">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Preview Image {{ $index + 1 }}">
                        <button type="button" class="remove-image" id="remove{{ $index + 1 }}" data-image-id="{{ $image->id }}">X</button>
                    </div>
                    <div class="square-content">
                        <input type="file" name="images[]" class="image-upload" id="upload{{ $index + 1 }}">
                        <label for="upload{{ $index + 1 }}" class="upload-label">+</label>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Additional empty square boxes for new images -->
            @for($i = $brand->images->count() + 1; $i <= 4; $i++) <div class="col">
                <div class="square-box">
                    <div class="image-preview-edit" style="display: none;" id="preview{{ $i }}">
                        <img src="" alt="Preview Image {{ $i }}">
                        <button type="button" class="remove-image" id="remove{{ $i }}">X</button>
                    </div>
                    <div class="square-content">
                        <input type="file" name="images[]" class="image-upload" id="upload{{ $i }}">
                        <label for="upload{{ $i }}" class="upload-label">+</label>
                    </div>
                </div>
        </div>
        @endfor
</div>

<!-- Hidden input fields for image IDs -->
@foreach($brand->images as $index => $image)
<input type="hidden" name="image_ids[]" value="{{ $image->id }}">
@endforeach
<div class="form-group mb-4">
    <label for="brand_category_ids">Categories:</label>
    <div>
        <button type="button" id="show-categories-btn" class="form-control text-left">Select Categories</button>
        <select name="brand_category_ids[]" id="brand_category_ids" class="form-control" multiple required style="display: none;">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ in_array($category->id, $brand->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-8">
        <button type="submit" class="btn btn-dark btn-block font-weight-bold">Зачувај</button>
    </div>
    <div class="col-4 align-self-center">
        <a href="{{ url()->previous() }}" class=" text-dark">Откажи</a>
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