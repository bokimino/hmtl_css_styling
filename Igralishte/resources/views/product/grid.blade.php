@extends('layouts.main')

@section('content')
<div class="">
    <div class="container mb-4">
        <div class="text-right">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="input-group mr-2 border roundedInput custom-input-border-color ">
                    <form action="{{ route('product.gridView') }}" method="GET" class="d-flex ml-2 justify-content-between w-100">
                        <input type="text" name="query" size="100%" class="form-control roundedInput bg-none border-0 py-2" placeholder="Пребарувај...">
                        <div class="input-group-append border-0 pr-1">
                            <button id="button-addon3" type="submit" class="btn px-1"><x-search-icon /></button>
                            <button id="" type="button" class="btn px-1 py-0 align-self-baseline "> <x-down-icon /></button>
                        </div>
                    </form>
                </div>
                <div class="btn-group " role="group" aria-label="Display Options">
                    <a href="{{ route('product.gridView') }}" class="roundedInput border p-1" id="grid-btn" style="background-color: #FFDBDB;"><x-grid-button /></a>
                    <a href="{{ route('product.listView') }}" class="roundedInput border p-1  ml-2" id="list-btn" style="background-color: white;"><x-list-button /></a>
                </div>
            </div>
            <a href="{{ route('products.create') }}" class="text-secondary inter-500">Додај нов продукт <x-add-button /></a>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="container cormorant-garamond-regular">
        <div class="row " id="grid">
            @foreach ($products as $product)
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card roundedInput bg-light">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-end">
                            <p class="card-text mb-1 text-muted  font-18">Само
                                {{ $product->quantity > 0 ? $product->quantity : '0' }}
                                парче
                            </p>
                            @if ($product->quantity < 1) <span class=" font-24">Продадено</span>
                                @endif
                        </div>
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
                                    <h5 class="card-title mb-0 font-24">{{ $product->name }}</h5>
                                </div>
                                <div>
                                    <span class="fancyOlive font-weight-bold inter-500  font-18">{{ $product->id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-0 bg-light pt-0 ">
                        <div class="text-dark d-block">
                            <small class="font-18">Боја:</small>
                            @foreach($product->colors as $color)
                            <div class="color-square rounded" <?php ?> style="background-color: {{ $color->hex }};"></div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-dark font-18">Величина:
                                @foreach($product->sizes as $size)
                                <span class="text-dark text-capitalize font-weight-bold"> {{ $size->name }}</span>
                                @if (!$loop->last),
                                @endif
                                @endforeach</small>
                            <small class="text-dark font-18">Цена: <span class="text-dark font-24 font-weight-bold">{{ $product->price }} ден.</span></small>
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
</div>
@endsection