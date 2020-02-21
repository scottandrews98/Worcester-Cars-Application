@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->


<!-- Header Section -->
<header class="secondaryHeader">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h1>Register</h1>
            </div> 
        </div>
    </div>
</header>

<section class="registerError">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @error('password')
                    <div class="card bg-warning">
                        <div class="card-body">
                            {{ $message }}
                        </div>
                    </div>
                @enderror
                @error('email')
                    <div class="card bg-warning">
                        <div class="card-body">
                            {{ $message }}
                        </div>
                    </div>
                @enderror
            </div>
        </div>
    </div>
</section>

<section class="signIn">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="text" placeholder="Name" name="name" value="{{ old('name') }}" required>
                    <input type="email" class="@error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required>
                    <input type="number" placeholder="Phone" name="number" value="{{ old('number') }}" required>
                    <input type="password" placeholder="Password (Must Be At Least 8 Characters)" class="@error('password') is-invalid @enderror" name="password" required>
                    <input type="password" placeholder="Confirm Password" name="password_confirmation" required>

                    <div class="row">
                        <div class="col-sm-2">
                            <input type="checkbox" placeholder="Do You Wish To Revieve Email's Off Worcester Cars When A New Car Comes For Sale?" name="emailConsent">  
                        </div>
                        <div class="col-sm-10">
                            <label for="emailConsent">Do You Wish To Revieve Email's Off Worcester Cars When A New Car Comes For Sale? </label><br>
                        </div>
                    </div>
    
                    <button type="submit"><a>Register</a></button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
