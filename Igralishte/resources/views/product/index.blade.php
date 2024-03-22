@extends('layouts.main')

@section('content')
<div class="container mb-4">
    <div class="text-right">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="input-group mr-2 border roundedInput custom-input-border-color ">
                <form action="{{ route('products.index') }}" method="GET" class="d-flex ml-2 justify-content-between">
                    <input type="text" name="query" size="100%" class="form-control roundedInput bg-none border-0 py-2" placeholder="Пребарувај...">
                    <div class="input-group-append border-0 ">
                        <button id="button-addon3" type="submit" class="btn px-1"><x-search-icon /></button>
                        <button id="" type="button" class="btn px-1 py-0 align-self-baseline "> <x-down-icon /></button>
                    </div>
                </form>
            </div>
            <div class="btn-group " role="group" aria-label="Display Options">
                <button type="button" class="roundedInput  p-1 " id="grid-btn" style="background-color: white;"><x-grid-button /></button>
                <button type="button" class="roundedInput  p-1  ml-2" id="list-btn" style="background-color: #FFDBDB;"><x-list-button /></button>
            </div>
        </div>
        <a href="{{ route('products.create') }}" class="text-secondary font-weight-bold ">Додај нов продукт <x-add-button /></a>
    </div>
</div>


<div class="container ">
    <!-- Display products as a list -->
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
                    <a href="{{ route('products.edit', $product->id) }}" class=""> <x-edit-button /></a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border-0 bg-light p-0" onclick="return confirm('Are you sure you want to delete?')"><x-delete-button /></button>
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
            <div class="card roundedInput bg-light">
                <div class="card-body p-3">
                    <p class="card-text mb-1 text-muted">Само {{ $product->quantity }} парче</p>
                    <div id="carousel{{ $product->id }}" class="carousel slide" data-ride="carousel" data-interval="false">
                        <div class="carousel-inner">
                            @foreach ($product->images as $index => $image)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->image) }}" class="d-block w-100 roundedInput" alt="Image {{ $index + 1 }}" style="height: 250px; object-fit: cover;">
                            </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel{{ $product->id }}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel{{ $product->id }}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-0">{{ $product->name }}</h5>
                            </div>
                            <div>
                                <span class="fancyOlive font-weight-bold">{{ $product->id }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-0 bg-light pt-0 ">
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
    <div class="container d-flex justify-content-center paginationBorder p-3 cormorant-garamond-regular h2">
        {{ $products->links('vendor.pagination.custom') }}
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