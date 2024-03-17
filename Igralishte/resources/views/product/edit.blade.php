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
                <button type="button" class="btn btn-sm btn-secondary decrease rounded-circle" style="width: 30px;">-</button>
                <input type="text" name="quantity" value="{{ $product->quantity }}" class="text-center border-0" style="width: 30px;" readonly>
                <button type="button" class="btn btn-sm btn-secondary increase rounded-circle" style="width: 30px;">+</button>
            </div>
        </div>

        <div class="form-group">
            <label>Sizes:</label><br>
            @foreach ($sizes as $size)
            <div class="form-check form-check-inline">
                <input type="checkbox" name="sizes[]" value="{{ $size->id }}" id="size{{ $size->id }}" class="size-checkbox visually-hidden" {{ in_array($size->id, $product->sizes->pluck('id')->toArray()) ? 'checked' : '' }}>
                <label class="size-label rounded text-uppercase font-weight-bold" for="size{{ $size->id }}">{{ $size->name }}</label>
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
                <input type="checkbox" name="colors[]" value="{{ $color->id }}" id="color{{ $color->id }}" class="form-check-input size-checkbox visually-hidden" {{ in_array($color->id, $product->colors->pluck('id')->toArray()) ? 'checked' : '' }}>
                <label class="form-check-label color-label rounded" for="color{{ $color->id }}" @if ($color->hex === '#FFFFFF')
                    style="background-color: {{ $color->hex }}; outline: 1px solid black;"
                    @else
                    style="background-color: {{ $color->hex }};"
                    @endif>
                </label>
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

        <label>Category:</label><br>
        <div class="form-row">
            <div class="form-group col-4">
                <select id="brand_id" name="brand_id" class="form-control">
                    <option value="">Одбери</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">
                        {{ $brand->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-4 offset-2">
                <select id="brand_category_id" name="brand_category_id" class="form-control">
                    <option value="">Одбери</option>
                    @foreach ($brandCategories as $category)
                    <option value="{{ $category->id }}" {{ $product->brand_category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>



        <div class="form-group">
            <button id="addDiscountButton" class="border-0 bg-white">Add Discount <x-add-button /></button>
            <div id="discountDropdown" class="mt-2" style="display: none;">
                <label for="discount_id">Select Discount:</label><br>
                <select class="form-control" id="discountSelect" name="discount_id">
                    @foreach($discounts as $discount)
                    <option value="{{ $discount->id }}">{{ $discount->id == $product->discount_id ? 'Одбрано' : '' }}->{{ $discount->code }}</option>
                    @endforeach
                </select>
            </div>
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


@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decreaseBtn = document.querySelector('.decrease');
        const increaseBtn = document.querySelector('.increase');
        const quantityInput = document.querySelector('input[name="quantity"]');

        decreaseBtn.addEventListener('click', function() {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;
            }
        });

        increaseBtn.addEventListener('click', function() {
            let quantity = parseInt(quantityInput.value);
            quantity++;
            quantityInput.value = quantity;
        });
    });

    $(document).ready(function() {
        $('#brand_id').change(function() {
            var brandId = $(this).val();
            if (brandId) {
                $.ajax({
                    type: 'GET',
                    url: '/fetch-brand-categories/' + brandId,
                    success: function(response) {
                        var options = '<option value="">Select Brand Category</option>';
                        $.each(response, function(index, category) {
                            options += '<option value="' + category.id + '">' + category.name + '</option>';
                        });
                        $('#brand_category_id').html(options);
                    }
                });
            } else {
                $('#brand_category_id').html('<option value="">Select Brand Category</option>');
            }
        });
    });
    document.getElementById('addDiscountButton').addEventListener('click', function(event) {
        event.preventDefault();
        var dropdown = document.getElementById('discountDropdown');
        var discountBtn = document.getElementById('addDiscountButton');
        if (dropdown.style.display === 'none') {
            dropdown.style.display = 'block';
            discountBtn.style.display = 'none';

        } else {
            dropdown.style.display = 'none';
        }
    });
</script>
@endsection