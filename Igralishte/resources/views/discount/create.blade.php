@extends('layouts.form')

@section('content')
<h1>Create New Discount</h1>

<div class="">
    <div class="p-3">
        <form action="{{ route('discounts.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-2">
                    <a href="{{ url()->previous() }}">
                        <!-- <i class="fa-solid fa-arrow-left-long"></i> -->
                        Back
                    </a>
                </div>
                <div class="form-group col-6">
                    <p>Попуст/промо код</p>
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
                <label for="code">Име на попуст / промо код</label>
                <input type="text" class="form-control" name="code" id="code" class="form-control rounded">
            </div>
            <div class="form-group">
                <label for="discount">Попуст</label>
                <input type="number" class="form-control" name="discount" id="discount" class="form-control">
            </div>
            <div class="form-group">
                <label for="category_id">Категорија</label>
                <select name="discount_category_id" id="category_id" class="form-control">
                    <option value="disabled">Одбери</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">

            </div>
            <div class="form-group">
                <label for="product_ids">Select Products:</label>
                <select name="product_ids[]" id="product_ids" class="form-control" multiple>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
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
</div>
@endsection