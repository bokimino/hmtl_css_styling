@extends('layouts.form')

@section('content')
<div class="container my-4">
    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-2">
                <a href="{{ url()->previous() }}">
                    <x-back-button />
                </a>
            </div>
            <div class="form-group col-6">
                <p>Brend</p>
            </div>
            <div class="form-group col-4">
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

        <div class="form-group">
            <label for="image1">Image 1:</label>
            <input type="file" name="images[]" id="image1" accept="image/*" multiple>

            <label for="image2">Image 2:</label>
            <input type="file" name="images[]" id="image2" accept="image/*" multiple>

            <label for="image3">Image 3:</label>
            <input type="file" name="images[]" id="image3" accept="image/*" multiple>

            <label for="image4">Image 4:</label>
            <input type="text" name="images[]" id="image4" accept="image/*" multiple>
        </div>

        <div class="form-group">
            <label for="images">Images:</label>
            <div id="image-preview-container">
                <div class="image-preview" id="image-preview">
                    <label for="image-upload" class="image-label">
                        +
                        <input type="file" id="image-upload" class="image-upload" accept="image/*" multiple>
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <button type="submit" class="btn btn-primary btn-block">Зачувај</button>
            </div>
            <div class="col-4">
                <a href="{{ url()->previous() }}" class="btn text-underline">Откажи</a>
            </div>
        </div>
    </form>
</div>
@endsection