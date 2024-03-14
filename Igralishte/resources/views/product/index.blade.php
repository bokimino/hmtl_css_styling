@extends('layouts.main')

@section('content')
<h1>Product List</h1>

<!-- Filter options go here -->

<div class="btn-group mb-3" role="group" aria-label="Display Options">
    <a href="{{ route('products.index', ['display' => 'list']) }}" class="btn btn-primary">List View</a>
    <a href="{{ route('products.index', ['display' => 'card']) }}" class="btn btn-primary">Card View</a>
</div>
<a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>

@if ($display === 'list')
<!-- Display products as a list -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<!-- Display products as cards -->
<div class="row">
    @foreach ($products as $product)
    <div class="col-md-4 mb-3">
        <div class="card">
            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">Quantity: {{ $product->quantity }}</p>
                <p class="card-text">Colors:
                    @foreach($product->colors as $color)
                    {{ $color->name }}
                    @if (!$loop->last)
                    , <!-- Add a comma if it's not the last color -->
                    @endif
                    @endforeach
                </p>
                <p class="card-text">Sizes:
                    @foreach($product->sizes as $size)
                    {{ $size->name }}
                    @if (!$loop->last),
                    @endif
                    @endforeach
                </p>
                <p class="card-text">Price: ${{ $product->price }}</p>

            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection