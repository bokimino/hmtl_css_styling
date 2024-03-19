@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a class="text-decoration-none" href="{{ url()->previous() }}">
                        <x-back-button />
                    </a>
                    <span>Промени лозинка</span>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.profile.updatePassword') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="current_password" class="col-lg-4 col-form-label text-lg-right">Стара лозинка</label>
                            <div class="col-lg-6">
                                <input id="current_password" type="password" class="form-control roundedInput @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current-password">
                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password" class="col-lg-4 col-form-label text-lg-right">Нова лозинка</label>
                            <div class="col-lg-6">
                                <input id="new_password" type="password" class="form-control roundedInput @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new-password">
                                @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password_confirmation" class="col-lg-4 col-form-label text-lg-right">Потврди нова лозинка</label>
                            <div class="col-lg-6">
                                <input id="new_password_confirmation" type="password" class="form-control roundedInput @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" required autocomplete="new-password">
                                @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <button type="submit" class="btn btn-dark btn-block font-weight-bold">Зачувај</button>
                            </div>
                            <div class="col-4 align-self-center">
                                <a href="{{ url()->previous() }}" class="text-dark">Откажи</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection