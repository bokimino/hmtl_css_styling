@extends('layouts.main')

@section('content')

<a href="{{ route('brands.create') }}" class="btn btn-primary">Create New Brand</a>

<!-- Active Brands -->
<div class="container">
    <h2>Активни</h2>

    @foreach($activeBrands as $brand)
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between">

            <div class="">
                <p class="mb-0">{{ $brand->name }}</p>
            </div>
            <div class="">
                <a href="{{ route('brands.edit', $brand->id) }}" class=""> <x-edit-button /></a>
                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                </form>
            </div>

        </div>
    </div>
    @endforeach


    <!-- Archived Brands -->
    <h2>Архива</h2>
    @foreach($archivedBrands as $brand)
    <div>
        <span>{{ $brand->name }}</span>
        <a href="{{ route('brands.edit', $brand->id) }}"><x-edit-button /></a>
        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete this brand?')">Delete</button>
        </form>
    </div>
    @endforeach
</div>
@endsection