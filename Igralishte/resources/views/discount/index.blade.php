@extends('layouts.main')
@section('content')
<div class="container">
    <div class="text-right mb-2">
        <div class="input-group mr-2 border roundedInput custom-input-border-color mb-3">
            <form action="{{ route('discounts.index') }}" method="GET" class="d-flex ml-2 justify-content-between">
                <input type="text" name="query" size="100%" class="form-control roundedInput bg-none border-0 py-2" placeholder="Пребарувај...">
                <div class="input-group-append border-0 ">
                    <button id="button-addon3" type="submit" class="btn "><x-search-icon /></button>
                </div>
            </form>
        </div>
        <a href="{{ route('discounts.create') }}" class="text-secondary font-weight-bold">Add New Discount <x-add-button /></a>
    </div>
</div>

<div class="container">
    <h2 class="h6">Активни</h2>

    @foreach ($activeDiscounts as $discount)
    <div class="card mb-3 roundedInput bg-light">
        <div class="card-body d-flex justify-content-between ">

            <div class="align-self-center">
                <p class="mb-0">{{ $discount->code }}</p>
            </div>
            <div class="">
                <a href="{{ route('discounts.edit', $discount->id) }}" class=""> <x-edit-button /></a>
                <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-0 bg-white p-0" onclick="return confirm('Are you sure you want to delete?')"><x-delete-button /></button>
                </form>
            </div>

        </div>
    </div>
    @endforeach


    <h2 class="h6">Архива</h2>


    @foreach ($inactiveDiscounts as $discount)
    <div class="card mb-3 roundedInput bg-light">
        <div class="card-body d-flex justify-content-between ">

            <div class="align-self-center">
                <p class="mb-0 text-secondary">{{ $discount->code }}</p>
            </div>
            <div class="">
                <a href="{{ route('discounts.edit', $discount->id) }}" class=""><x-edit-button /></a>
                <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST" class="d-inline">
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