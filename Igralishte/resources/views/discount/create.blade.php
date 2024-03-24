@extends('layouts.form')

@section('content')
<div class="inter-500">
    <div class="p-3">
        <form action="{{ route('discounts.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-6 d-flex align-items-center">
                    <a href="{{ url()->previous() }}">
                        <x-back-button />
                    </a>
                    <p class="ml-2 mb-0">Попуст/промо код</p>
                </div>
                <div class="form-group col col-md-2 col-lg-2 offset-2 offset-md-4">
                    <select name="is_active" id="is_active" class="form-control roundedInput @error('is_active') is-invalid @enderror" value="{{ old('is_active') }}>
                    <option value=" disabled">Статус</option>
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
                <label for="code">Име на попуст / промо код</label>
                <input type="text" class="form-control roundedInput @error('code') is-invalid @enderror" name="code" id="code" value="{{ old('code') }}">
                @error('code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="discount">Попуст</label>
                <input type="number" class="form-control roundedInput @error('discount') is-invalid @enderror" name="discount" id="discount" value="{{ old('discount') }}">
                @error('discount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="category_id">Категорија</label>
                <select name="discount_category_id" id="category_id" class="form-control roundedInput">
                    <option value="disabled">Одбери</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('discount_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('discount_category_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="product_ids">Постави попуст на:</label>
                <select name="product_ids[]" id="product_ids" class="form-control roundedInput" multiple>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ in_array($product->id, (array) old('product_ids', [])) ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('product_ids')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row mt-5">
                <div class="col-8">
                    <button type="submit" class="btn btn-dark btn-block font-weight-bold roundedInput">Зачувај</button>
                </div>
                <div class="col-4 align-self-center">
                    <a href="{{ url()->previous() }}" class="text-dark">Откажи</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection