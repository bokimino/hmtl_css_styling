@extends('layouts.main')

@section('content')
<div class="container mb-4">
    <div class="text-right">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="input-group mr-2 border roundedInput custom-input-border-color ">
                <form action="{{ route('product.listView') }}" method="GET" class="d-flex ml-2 justify-content-between">
                    <input type="text" name="query" size="100%" class="form-control roundedInput bg-none border-0 py-2" placeholder="Пребарувај...">
                    <div class="input-group-append border-0 ">
                        <button id="button-addon3" type="submit" class="btn px-1"><x-search-icon /></button>
                        <button id="" type="button" class="btn px-1 py-0 align-self-baseline "> <x-down-icon /></button>
                    </div>
                </form>
            </div>
            <div class="btn-group " role="group" aria-label="Display Options">
                <a href="{{ route('product.gridView') }}" class="roundedInput border p-1" id="grid-btn" style="background-color: white;"><x-grid-button /></a>
                <a href="{{ route('product.listView') }}" class="roundedInput border p-1  ml-2" id="list-btn" style="background-color: #FFDBDB;"><x-list-button /></a>
            </div>
        </div>
        <a href="{{ route('products.create') }}" class="text-secondary font-weight-bold ">Додај нов продукт <x-add-button /></a>
    </div>
</div>


<div class="container ">
<div class="div" id="list">
        @foreach ($products as $product)
        <div class="card mb-3 roundedInput bg-light">
            <div class="card-body d-flex justify-content-between px-4 py-3">
                <div class="align-self-center">
                    <p class="m-0">
                        <span class="fancyOlive font-weight-bold {{ $product->is_active ? '' : 'text-secondary' }}">{{ $product->id }}</span>
                        <span class="{{ $product->is_active ? '' : 'text-secondary' }}">{{ $product->name }}</span>
                    </p>
                </div>

                <div class="">
                    <a href="{{ route('products.edit', $product->id) }}" class="text-decoration-none"> <x-edit-button /></a>
                    <!-- display None set on DELETE -->
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border-0 bg-light p-0" onclick="return confirm('Are you sure you want to delete?')"><x-delete-button /></button>
                    </form>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    <div class="container d-flex justify-content-center paginationBorder p-3 cormorant-garamond-regular h2">
        {{ $products->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection