@extends('layouts.main')

@section('content')

<h1>Активни</h1>

<a href="{{ route('discounts.create') }}" class="btn btn-primary">Add New Discount</a>
<table>
    <thead>
        <tr>
            <th>Code</th>
            <th>Discount</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($activeDiscounts as $discount)
        <tr>
            <td>{{ $discount->code }}</td>
            <td>{{ $discount->discount }}</td>
            <td>{{ $discount->category->name }}</td>
            <td>
                <a href="{{ route('discounts.edit', $discount->id) }}"><x-edit-button /></a>
                <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirmDelete()">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<h1>Архива</h1>

<table>
    <thead>
        <tr>
            <th>Code</th>
            <th>Discount</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inactiveDiscounts as $discount)
        <tr>
            <td>{{ $discount->code }}</td>
            <td>{{ $discount->discount }}</td>
            <td>{{ $discount->category->name }}</td>
            <td>
                <a href="{{ route('discounts.edit', $discount->id) }}"><x-edit-button /></a>
                <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirmDelete()">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection