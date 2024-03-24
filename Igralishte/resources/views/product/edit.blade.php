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
                <select name="is_active" id="is_active" class="form-control roundedInput">
                    <option value="1" {{ $product->is_active ? 'selected' : '' }}>Активен</option>
                    <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Архивирај</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Име на продуктот:</label>
            <input type="text" name="name" class="form-control roundedInput" value="{{ $product->name }}">
        </div>

        <div class="form-group">
            <label>Опис:</label>
            <textarea name="description" class="form-control roundedInput">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Цена:</label>
            <input type="text" name="price" class="form-control roundedInput" value="{{ $product->price }}">
        </div>

        <div class="form-group d-flex">
            <label class="mb-0">Количина:</label>
            <div class="quantity-input ml-3">
                <button type="button" class="btn btn-sm btn-white border decrease rounded-circle" style="width: 30px;"><x-decrease-icon/></button>
                <input type="text" name="quantity" value="{{ $product->quantity }}" class="text-center border-0" style="width: 30px;" readonly>
                <button type="button" class="btn btn-sm btn-white border increase rounded-circle" style="width: 30px;"><x-increase-icon/></button>
            </div>
        </div>

        <div class="form-group d-flex">
            <label class="mr-3">Величина:</label><br>
            @foreach ($sizes as $size)
            <div class="form-check form-check-inline">
                <input type="checkbox" name="sizes[]" value="{{ $size->id }}" id="size{{ $size->id }}" class="size-checkbox visually-hidden" {{ in_array($size->id, $product->sizes->pluck('id')->toArray()) ? 'checked' : '' }}>
                <label class="size-label rounded mr-0 text-uppercase font-weight-bold" for="size{{ $size->id }}">{{ $size->name }}</label>
            </div>
            @endforeach
        </div>


        <div class="form-group">
            <label>Совет за величина:</label>
            <textarea name="size_description" class="form-control roundedInput">{{ $product->size_description }}</textarea>
        </div>

        <div class="form-group">
            <label>Боја:</label><br>
            @foreach ($colors as $color)
            <div class="form-check form-check-inline mr-0">
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
            <label>Насоки за одржување:</label>
            <input type="text" name="maintenance" class="form-control roundedInput" value="{{ $product->maintenance }}">
        </div>

        <div class="form-group">
            <label for="tags">Ознаки:</label>
            <input type="text" name="tags" id="tags" class="form-control roundedInput" placeholder="Enter tags separated by commas" value="{{ $product->tags->implode('name', ', ') }}">
        </div>

        <label for="">Слики:</label>
        <div class="row">
            @foreach($productImages as $index => $image)
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

@foreach($productImages as $index => $productImage)
<input type="hidden" name="existing_image_ids[]" value="{{ $productImage->id }}">
@endforeach
<label>Категорија:</label><br>
<div class="form-row">
    <div class="form-group col-4">
        <select id="brand_id" name="brand_id" class="form-control roundedInput">
            <option value="">Одбери</option>
            @foreach ($brands as $brand)
            <option value="{{ $brand->id }}">
                {{ $brand->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-4 offset-1">
        <select id="brand_category_id" name="brand_category_id" class="form-control roundedInput">
            <option value="">Одбери</option>
            @foreach ($brandCategories as $category)
            <option value="{{ $category->id }}" {{ $product->brand_category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>
</div>


<div class="row mt-3">
    <div class="col-8">
        <button type="submit" class="btn btn-dark btn-block font-weight-bold roundedInput">Зачувај</button>
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
</script>
@endsection