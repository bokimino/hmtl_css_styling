@extends('layouts.form')

@section('content')
<div class="p-3">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group col d-flex align-items-center">
                <a href="{{ url()->previous() }}">
                    <x-back-button />
                </a>
                <p class="ml-2 mb-0">Продукт</p>
            </div>
            <div class="form-group col col-md-2 col-lg-2 offset-md-4 offset-lg-4">
                <select name="is_active" id="is_active" class="form-control">
                    <option value="1" {{ $product->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}">
        </div>

        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input type="text" name="price" class="form-control" value="{{ $product->price }}">
        </div>

        <div class="form-group">
            <label>Quantity:</label>
            <div class="quantity-input">
                <button type="button" class="btn btn-sm btn-secondary decrease">-</button>
                <input type="text" name="quantity" value="{{ $product->quantity }}" class="form-control" readonly>
                <button type="button" class="btn btn-sm btn-secondary increase">+</button>
            </div>
        </div>

        <div class="form-group">
            <label>Sizes:</label><br>
            @foreach ($sizes as $size)
            <div class="form-check form-check-inline">
                <input type="checkbox" name="sizes[]" value="{{ $size->id }}" id="size{{ $size->id }}" class="form-check-input" {{ in_array($size->id, $product->sizes->pluck('id')->toArray()) ? 'checked' : '' }}>
                <label class="form-check-label" for="size{{ $size->id }}">{{ $size->name }}</label>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <label>Size Description:</label>
            <textarea name="size_description" class="form-control">{{ $product->size_description }}</textarea>
        </div>

        <div class="form-group">
            <label>Colors:</label><br>
            @foreach ($colors as $color)
            <div class="form-check form-check-inline">
                <input type="checkbox" name="colors[]" value="{{ $color->id }}" id="color{{ $color->id }}" class="form-check-input" {{ in_array($color->id, $product->colors->pluck('id')->toArray()) ? 'checked' : '' }}>
                <label class="form-check-label" for="color{{ $color->id }}">{{ $color->name }}</label>
            </div>
            @endforeach
        </div>

        <div class="form-group">
            <label>Maintenance:</label>
            <input type="text" name="maintenance" class="form-control" value="{{ $product->maintenance }}">
        </div>

        <div class="form-group">
            <label for="tags">Tags:</label>
            <input type="text" name="tags" id="tags" class="form-control" placeholder="Enter tags separated by commas" value="{{ $product->tags->implode('name', ', ') }}">
        </div>

        <div class="form-group">
            <label for="brand_id">Brand:</label>
            <select id="brand_id" name="brand_id" class="form-control">
                <option value="">Select Brand</option>
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="brand_category_id">Brand Category:</label>
            <select id="brand_category_id" name="brand_category_id" class="form-control">
                <option value="">Select Brand Category</option>
                @foreach ($brandCategories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $product->brand_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="discount_id">Discount:</label><br>
            <select class="form-control" id="discountSelect" name="discount_id">
                <option value="">Select Discount</option>
                @foreach($discounts as $discount)
                <option value="{{ $discount->id }}" {{ $discount->id == $product->discount_id ? 'selected' : '' }}>{{ $discount->code }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-8">
                <button type="submit" class="btn btn-dark btn-block font-weight-bold">Зачувај</button>
            </div>
            <div class="col-4 align-self-center">
                <a href="{{ url()->previous() }}" class="underline text-dark">Откажи</a>
            </div>
        </div>

    </form>
</div>
@endsection