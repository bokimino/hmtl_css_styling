@extends('layouts.main')

@section('content')
<div class="container">
    <div class="text-right mb-2">
        <div class="d-flex justify-content-between align-items-center">
            <form class="form-inline mb-3 w-100 mr-2">
                <input class="form-control roundedInput" type="search" placeholder="Search" aria-label="Search">
            </form>
            <div class="btn-group mb-3" role="group" aria-label="Display Options">
                <a href="{{ route('products.index', ['display' => 'card']) }}" class="rounded bg-primary p-1"><x-grid-button /></a>
                <a href="{{ route('products.index', ['display' => 'list']) }}" class="rounded bg-primary p-1"><x-list-button /></a>
            </div>
        </div>
        <a href="{{ route('products.create') }}" class="text-secondary font-weight-bold">Add New Product <x-add-button /></a>
    </div>
</div>
<!-- Filter options go here -->
<div class="container">
    @if ($display === 'list')
    <!-- Display products as a list -->

    @foreach ($products as $product)
    <div class="card mb-3 roundedInput">
        <div class="card-body d-flex justify-content-between px-4 py-3">


            <div class="align-self-center">
                <p class="m-0">{{ $product->id }} {{ $product->name }}</p>
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

    @else
    <!-- Display products as cards -->
    <div class="row">
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
                    <small class="text-muted d-block">Colors:
                        @foreach($product->colors as $color)
                        {{ $color->name }}
                        @if (!$loop->last)
                        , <!-- Add a comma if it's not the last color -->
                        @endif
                        @endforeach</small>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">Sizes:
                            @foreach($product->sizes as $size)
                            {{ $size->name }}
                            @if (!$loop->last),
                            @endif
                            @endforeach</small>
                        <small class="text-muted">Price: ${{ $product->price }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection