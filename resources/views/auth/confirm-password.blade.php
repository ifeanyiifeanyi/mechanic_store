@extends('layouts.guest')

@section('title', 'Confirm Password')

@section('guest')
    <div class="login-box">

        <div class="card">

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-body login-card-body">
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <p class="login-box-msg">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>

                <form action="{{ route('password.confirm') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                            placeholder="Password" required autofocus autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Confirm') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

@endsection
