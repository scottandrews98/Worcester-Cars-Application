@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Sign In</h1>
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
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <label for="email" style="font-size: 0px">Email</label>
                        <input class="@error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" placeholder="Email" name="email" id="email" required>

                        <label for="password" style="font-size: 0px">Password</label>
                        <input class="@error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" id="password" required>

                        <button type="submit"><a>Sign In</a></button>

                        <a href="/google/redirect" role="button" style="text-transform:none; margin-bottom: 26px">
                        <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                            Sign In With Google
                        </a>

                        <a id="register" href="/register">Register</a>

                        <a href="/password/reset">Forgot Password</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
