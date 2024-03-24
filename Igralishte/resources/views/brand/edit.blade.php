@extends('layouts.form')

@section('content')

<div class="inter-500">
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
                <div class="form-group col col-md-2 col-lg-2 offset-4">
                    <select name="is_active" id="is_active" class="form-control roundedInput">
                        <option value="1" {{ $brand->is_active ? 'selected' : '' }}>Активен</option>
                        <option value="0" {{ !$brand->is_active ? 'selected' : '' }}>Архивирај</option>
                    </select>
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $is_active }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="name">Име на бренд:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $brand->name) }}" class="form-control roundedInput" required>
                @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Опис:</label>
                <textarea name="description" id="description" class="form-control roundedInput">{{ $brand->description }}</textarea>
                @error('description')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tags">Ознаки:</label>
                <input type="text" name="tags" id="tags" class="form-control roundedInput" value="{{ implode(', ', $brand->tags->pluck('name')->toArray()) }}">
                @error('tags')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>


            <label for="">Слики:</label>
            <div class="row">
                @foreach($productImages->take(4) as $index => $image)
                <div class="col">
                    <div class="square-box">
                        <div class="image-preview-edit" id="preview{{ $index + 1 }}">
                            <img src="{{ asset('storage/' . $image->image) }}" alt="Preview Image {{ $index + 1 }}">
                            <button type="button" class="remove-image" id="remove{{ $index + 1 }}" data-image-id="{{ $image->id }}">X</button>
                        </div>
                        <div class="square-content">
                            <input type="file" name="images[]" class="image-upload" id="upload{{ $index + 1 }}">
                            <label for="upload{{ $index + 1 }}" class="upload-label">+</label>
                        </div>
                    </div>
                </div>
                @endforeach
                @for($i = $productImages->count() + 1; $i <= 4; $i++) <div class="col">
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
    @foreach($productImages as $index => $image)
    <input type="hidden" name="existing_image_ids[]" value="{{ $image->id }}">
    @endforeach
    <div class="form-group mt-2">
        <label for="brand_category_ids">Категорија:</label>
        <div>
            <button type="button" id="show-categories-btn" class="form-control text-left roundedInput">Одбери</button>
            <select name="brand_category_ids[]" id="brand_category_ids" class="form-control" multiple required style="display: none;">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ (is_array(old('brand_category_ids')) && in_array($category->id, old('brand_category_ids'))) || (is_array($brand->categories->pluck('id')->toArray()) && in_array($category->id, $brand->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('brand_category_ids')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-8">
            <button type="submit" class="btn btn-dark btn-block font-weight-bold roundedInput">Зачувај</button>
        </div>
        <div class="col-4 align-self-center">
            <a href="{{ url()->previous() }}" class=" text-dark">Откажи</a>
        </div>
    </div>
    </form>
</div>
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