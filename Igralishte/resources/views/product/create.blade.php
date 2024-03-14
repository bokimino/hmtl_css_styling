@extends('layouts.form')

@section('content')
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Status:</label><br>
        <select name="is_active" class="form-control">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Price:</label>
        <input type="text" name="price" class="form-control">
    </div>

    <div class="form-group">
        <label>Quantity:</label>
        <div class="quantity-input">
            <button type="button" class="btn btn-sm btn-secondary decrease">-</button>
            <input type="text" name="quantity" value="1" class="form-control" readonly>
            <button type="button" class="btn btn-sm btn-secondary increase">+</button>
        </div>
    </div>

    <div class="form-group">
        <label>Sizes:</label><br>
        @foreach ($sizes as $size)
        <input type="checkbox" name="sizes[]" value="{{ $size->id }}" id="size{{ $size->id }}" class="size-checkbox visually-hidden">
        <label for="size{{ $size->id }}" class="size-label">{{ $size->name }}</label>
        @endforeach
    </div>

    <div class="form-group">
        <label>Size Description:</label>
        <textarea name="size_description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Colors:</label><br>
        @foreach ($colors as $color)
        <div class="form-check form-check-inline">
            <input type="checkbox" name="colors[]" value="{{ $color->id }}" id="color{{ $color->id }}" class="form-check-input">
            <label class="form-check-label" for="color{{ $color->id }}">{{ $color->name }}</label>
        </div>
        @endforeach
    </div>

    <div class="form-group">
        <label>Maintenance:</label>
        <input type="text" name="maintenance" class="form-control">
    </div>


    <div class="form-group">
        <label for="tags">Tags:</label>
        <input type="text" name="tags" id="tags" class="form-control" placeholder="Enter tags separated by commas">
    </div>


    <div class="form-group">
        <label>Category:</label><br>
        <!-- Add dropdown for selecting category -->
    </div>

    <div class="form-group">
        <label for="brand_id">Brand:</label>
        <select id="brand_id" name="brand_id" class="form-control">
            <option value="">Select Brand</option>
            @foreach ($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="brand_category_id">Brand Category:</label>
        <select id="brand_category_id" name="brand_category_id" class="form-control">
            <option value="">Select Brand Category</option>
            @foreach ($brandCategories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="discount_id">Discount:</label><br>
        <select class="form-control" id="discountSelect" name="discount_id">
            @foreach($discounts as $discount)
            <option value="{{ $discount->id }}">{{ $discount->code }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>


@endsection