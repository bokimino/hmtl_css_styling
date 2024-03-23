@extends('layouts.loginApp')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Адреса</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mb-0">
                <label for="password">Лозинка</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group form-check px-0">
                @if (Route::has('password.request'))
                <a class="btn btn-link fancyOlive px-0" href="{{ route('password.request') }}">
                    Ја заборави лозинката ?
                </a>
                @endif
            </div>
            <button type="submit" class="btn btn-block btn-dark">
                Логирај се
            </button>
        </form>

    </div>
</div>
@endsection