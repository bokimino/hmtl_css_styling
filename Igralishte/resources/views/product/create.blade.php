@extends('layouts.form')

@section('content')
<div class="p-3">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col d-flex align-items-center">
                <a href="{{ url()->previous() }}">
                    <x-back-button />
                </a>
                <p class="ml-2 mb-0">Продукт</p>
            </div>

            <div class="form-group col col-md-2 col-lg-2 offset-md-4 offset-lg-4">
                <select name="is_active" id="is_active" class="form-control roundedInput">
                    <option value="disabled">Статус</option>
                    <option value="1">Активен</option>
                    <option value="0">Архивирај</option>
                </select>
                @error('is_active')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control roundedInput">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control"></textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input type="text" name="price" class="form-control">
            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label>Quantity:</label>
            <div class="quantity-input">
                <button type="button" class="btn btn-sm btn-white border decrease rounded-circle" style="width: 30px;">-</button>
                <input type="text" name="quantity" value="1" class="text-center border-0" style="width: 30px;" readonly>
                <button type="button" class="btn btn-sm btn-white border increase rounded-circle" style="width: 30px;">+</button>
            </div>
            @error('quantity')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label>Sizes:</label><br>
            @foreach ($sizes as $size)
            <input type="checkbox" name="sizes[]" value="{{ $size->id }}" id="size{{ $size->id }}" class="size-checkbox visually-hidden">
            <label for="size{{ $size->id }}" class="size-label rounded text-uppercase font-weight-bold">{{ $size->name }}</label>
            @endforeach
            @error('sizes')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label>Size Description:</label>
            <textarea name="size_description" class="form-control"></textarea>
            @error('size_description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label>Colors:</label><br>
            @foreach ($colors as $color)
            <div class="form-check form-check-inline mr-0">
                <input type="checkbox" name="colors[]" value="{{ $color->id }}" id="color{{ $color->id }}" class="form-check-input size-checkbox visually-hidden">
                <label class="form-check-label color-label rounded" for="color{{ $color->id }}" @if ($color->hex === '#FFFFFF')
                    style="background-color: {{ $color->hex }}; outline: 1px solid black;"
                    @else
                    style="background-color: {{ $color->hex }};"
                    @endif>
                </label>
            </div>
            @error('colors')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @endforeach
        </div>

        <div class="form-group">
            <label>Maintenance:</label>
            <input type="text" name="maintenance" class="form-control">
            @error('maintenance')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="tags">Tags:</label>
            <input type="text" name="tags" id="tags" class="form-control" placeholder="Enter tags separated by commas">
            @error('tags')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="row">
            @for($i = 1; $i <= 4; $i++) <div class="col">
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
                @error('images')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>
        @endfor

</div>

<label>Category:</label><br>
<div class="form-row">
    <div class="form-group col-4">
        <select id="brand_id" name="brand_id" class="form-control">
            <option value="">Одбери</option>
            @foreach ($brands as $brand)
            @if ($brand->is_active)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endif
            @endforeach
        </select>
        @error('brand_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group col-4 offset-1">
        <select id="brand_category_id" name="brand_category_id" class="form-control">
            <option value="">Одбери</option>
        </select>
        @error('brand_category_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row mt-3">
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