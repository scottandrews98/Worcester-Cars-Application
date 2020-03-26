@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Forgot Password</h1>
                </div> 
                <div class="col-sm">
                    <a href="/login">Back</a>
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
                    @if (session('status'))
                        <div class="card">
                            <div class="card-body">
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="signIn">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <input class="@error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" placeholder="Email" name="email" required autocomplete="email" autofocus>

                        <button type="submit"><a>Send Password Reset Email</a></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
