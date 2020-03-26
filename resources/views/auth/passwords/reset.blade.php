@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Reset Password</h1>
                </div> 
            </div>
        </div>
    </header>

    <section class="signinError">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @error('email')
                        <div class="card">
                            <div class="card-body">
                                {{ $message }}
                            </div>
                        </div>
                    @enderror
                    @error('password')
                        <div class="card">
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
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <input class="@error('email') is-invalid @enderror" type="email" value="{{ $email ?? old('email') }}" placeholder="Email" name="email" required autocomplete="email" autofocus>

                        <input type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">

                        <input type="password"  name="password_confirmation" required autocomplete="new-password" placeholder="New Password Confirm">

                        <button type="submit"><a>Reset Password</a></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
