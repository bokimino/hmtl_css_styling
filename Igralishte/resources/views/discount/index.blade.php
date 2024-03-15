@extends('layouts.main')

@section('content')
<div class="container">
    <div class="text-right mb-2">
        <form class="form-inline mb-3">
            <input class="form-control roundedInput w-100" type="search" placeholder="Search" aria-label="Search">
        </form>
        <a href="{{ route('discounts.create') }}" class="text-secondary font-weight-bold">Add New Discount <x-add-button /></a>
    </div>
</div>

<div class="container">
    <h2 class="h6">Активни</h2>

    @foreach ($activeDiscounts as $discount)
    <div class="card mb-3 roundedInput">
        <div class="card-body d-flex justify-content-between ">

            <div class="align-self-center">
                <p class="mb-0">{{ $discount->code }}</p>
            </div>
            <div class="">
                <a href="{{ route('discounts.edit', $discount->id) }}" class=""> <x-edit-button /></a>
                <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-0 bg-white p-0" onclick="return confirmDelete()"><x-delete-button /></button>
                </form>
            </div>

        </div>
    </div>
    @endforeach


    <h2 class="h6">Архива</h2>


    @foreach ($inactiveDiscounts as $discount)
    <div class="card mb-3 roundedInput">
        <div class="card-body d-flex justify-content-between ">

            <div class="align-self-center">
                <p class="mb-0 text-secondary">{{ $discount->code }}</p>
            </div>
            <div class="">
                <a href="{{ route('discounts.edit', $discount->id) }}" class=""><x-edit-button /></a>
                <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-0 bg-white p-0" onclick="return confirmDelete()"><x-delete-button /></button>
                </form>
            </div>

        </div>
    </div>
    @endforeach
</div>

@endsection