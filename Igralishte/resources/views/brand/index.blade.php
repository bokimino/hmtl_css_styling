@extends('layouts.main')

@section('content')
<div class="container">
    <div class="text-right mb-2">
        <form class="form-inline mb-3">
            <input class="form-control roundedInput w-100" type="search" placeholder="Search" aria-label="Search">
        </form>
        <a href="{{ route('brands.create') }}" class="text-secondary font-weight-bold">Create New Brand <x-add-button /></a>
    </div>
</div>

<!-- Active Brands -->
<div class="container">
    <h2 class="h6">Активни</h2>

    @foreach($activeBrands as $brand)
    <div class="card mb-3 roundedInput">
        <div class="card-body d-flex justify-content-between ">

            <div class="align-self-center">
                <p class="mb-0">{{ $brand->name }}</p>
            </div>
            <div class="">
                <a href="{{ route('brands.edit', $brand->id) }}" class=""> <x-edit-button /></a>
                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-0 bg-white p-0" onclick="return confirm('Are you sure you want to delete?')"><x-delete-button /></button>
                </form>
            </div>

        </div>
    </div>
    @endforeach


    <!-- Archived Brands -->
    <h2 class="h6">Архива</h2>
    @foreach($archivedBrands as $brand)
    <div class="card mb-3 roundedInput">
        <div class="card-body d-flex justify-content-between ">

            <div class="align-self-center">
                <p class="mb-0 text-secondary">{{ $brand->name }}</p>
            </div>
            <div class="">
                <a href="{{ route('brands.edit', $brand->id) }}" class=""> <x-edit-button /></a>
                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-0 bg-white p-0" onclick="return confirm('Are you sure you want to delete?')"><x-delete-button /></button>
                </form>
            </div>

        </div>
    </div>

    @endforeach
</div>
@endsection