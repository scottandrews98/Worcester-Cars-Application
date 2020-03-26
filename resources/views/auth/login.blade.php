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

                        <input class="@error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" placeholder="Email" name="email" required>

                        <input class="@error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" required>

                        <button type="submit"><a>Sign In</a></button>

                        <a id="register" href="/register">Register</a>

                        <a href="/password/reset">Forgot Password</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
