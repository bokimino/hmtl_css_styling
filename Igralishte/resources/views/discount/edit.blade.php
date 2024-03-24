@extends('layouts.form')

@section('content')

<div class="container-lg p-3">
    <form action="{{ route('discounts.update', $discount) }}" method="POST">
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
                    <option value="1" {{ $discount->is_active ? 'selected' : '' }}>Активен</option>
                    <option value="0" {{ !$discount->is_active ? 'selected' : '' }}>Архивирај</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="code">Име на попуст / промо код:</label>
            <input type="text" name="code" id="code" class="form-control roundedInput" value="{{ $discount->code }}">
        </div>
        <div class="form-group">
            <label for="discount">Попуст:</label>
            <input type="number" name="discount" id="discount" class="form-control roundedInput" value="{{ $discount->discount }}">
        </div>
        <div class="form-group">
            <label for="category">Категорија:</label>
            <select name="discount_category_id" id="category" class="form-control roundedInput">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $discount->discount_category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_ids">Постави попуст на:</label>
            <select name="product_ids[]" id="product_ids" class="form-control roundedInput" multiple>
                @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ $discount->products->contains($product) ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="row">
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