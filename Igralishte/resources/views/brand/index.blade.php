@extends('layouts.main')

@section('content')

<div class="container">
    <div class="text-right mb-2">
        <div class="input-group mr-2 border roundedInput custom-input-border-color mb-3 ">
            <form action="{{ route('brands.index') }}" method="GET" class="d-flex ml-2 justify-content-between w-100">
                <input type="text" name="query" size="100%" class="form-control roundedInput bg-none border-0 py-2" placeholder="Пребарувај...">
                <div class="input-group-append border-0 mr-2">
                    <button id="button-addon3" type="submit" class="btn px-2"><x-search-icon /></button>
                    <button id="" type="button" class="btn px-1 py-0 align-self-baseline "> <x-down-icon /></button>
                </div>
            </form>
        </div>
        <a href="{{ route('brands.create') }}" class="text-secondary inter-500">Додај нов бренд <x-add-button /></a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<!-- Active Brands -->
<div class="container inter-500">
    <h2 class="h6">Активни</h2>

    @foreach($activeBrands as $brand)
    <div class="card mb-3 roundedInput bg-light">
        <div class="card-body d-flex justify-content-between ">

            <div class="align-self-center">
                <p class="mb-0">{{ $brand->name }}</p>
            </div>
            <div class="">
                <a href="{{ route('brands.edit', $brand->id) }}" class=""> <x-edit-button /></a>
                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-0 bg-light p-0" onclick="return confirm('Are you sure you want to delete?')"><x-delete-button /></button>
                </form>
            </div>

        </div>
    </div>
    @endforeach


    <!-- Archived Brands -->
    <h2 class="h6 text-secondary">Архива</h2>
    @foreach($archivedBrands as $brand)
    <div class="card mb-3 roundedInput bg-light">
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