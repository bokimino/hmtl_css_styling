@extends('layouts.main')

@section('content')
<div class="container">
    <div class="text-right mb-2">
        <div class="d-flex justify-content-between align-items-center">
            <div class="input-group mb-4 border roundedInput ">
                <form action="{{ route('products.index') }}" method="GET" class="d-flex ml-2 justify-content-between">
                    <input type="text" name="query" class="form-control bg-none border-0 py-2" placeholder="Пребарувај...">
                    <div class="input-group-append border-0">
                        <button id="button-addon3" type="button" class="btn "><x-search-icon /></button>
                    </div>
                </form>
            </div>
            <div class="btn-group mb-3" role="group" aria-label="Display Options">
                <button type="button" class="roundedInput  p-1 " id="grid-btn" style="background-color: white;"><x-grid-button /></button>
                <button type="button" class="roundedInput  p-1  ml-2" id="list-btn" style="background-color: #FFDBDB;"><x-list-button /></button>
            </div>
        </div>
        <a href="{{ route('products.create') }}" class="text-secondary font-weight-bold">Add New Product <x-add-button /></a>
    </div>
</div>

<!-- Filter options go here -->

<div class="container ">
    <!-- Display products as a list -->
    <div class="div" id="list">
        @foreach ($products as $product)
        <div class="card mb-3 roundedInput ">
            <div class="card-body d-flex justify-content-between px-4 py-3">
                <div class="align-self-center">
                    <p class="m-0">
                        <span class="fancyOlive font-weight-bold {{ $product->is_active ? '' : 'text-secondary' }}">{{ $product->id }}</span>
                        <span class="{{ $product->is_active ? '' : 'text-secondary' }}">{{ $product->name }}</span>
                    </p>
                </div>

                <div class="">
                    <a href="{{ route('products.edit', $product->id) }}" class=""> <x-edit-button /></a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border-0 bg-white p-0" onclick="return confirm('Are you sure you want to delete?')"><x-delete-button /></button>
                    </form>
                </div>

            </div>
        </div>
        @endforeach
    </div>


    <!-- Display products as cards -->
    <div class="row " id="grid" style="display: none;">
        @foreach ($products as $product)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card roundedInput">
                <!-- <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}"> -->
                <div class="card-body p-3">
                    <p class="card-text mb-1">Quantity: {{ $product->quantity }}</p>
                    <img src="https://picsum.photos/id/237/200/300" height="240" width="240" class="roundedInput w-100" alt="{{ $product->name }}">
                    <h5 class="card-title mb-0 mt-2">{{ $product->name }} {{ $product->id }}</h5>
                </div>
                <div class="card-footer border-0 bg-white pt-0">
                    <div class="text-muted d-block">
                        <small>Colors:</small>
                        @foreach($product->colors as $color)
                        <div class="color-square rounded" <?php ?> style="background-color: {{ $color->hex }};"></div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">Sizes:
                            @foreach($product->sizes as $size)
                            <span class="text-dark text-capitalize"> {{ $size->name }}</span>
                            @if (!$loop->last),
                            @endif
                            @endforeach</small>
                        <small class="text-muted">Price: <span class="text-dark">{{ $product->price }} ден.</span></small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const gridBtn = document.getElementById('grid-btn');
        const listBtn = document.getElementById('list-btn');
        const gridDiv = document.getElementById('grid');
        const listDiv = document.getElementById('list');

        gridBtn.addEventListener('click', function() {
            gridDiv.style.display = 'flex';
            listDiv.style.display = 'none';
            gridBtn.style.background = '#FFDBDB';
            listBtn.style.background = 'white';

        });

        listBtn.addEventListener('click', function() {
            gridDiv.style.display = 'none';
            listDiv.style.display = 'block';
            gridBtn.style.background = 'white';
            listBtn.style.background = '#FFDBDB';
        });


    });
</script>
@endsection