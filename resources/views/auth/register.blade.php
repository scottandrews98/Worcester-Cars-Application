@extends('layouts.app')

@section('content')
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
                                <label for="emailConsent">Do You Wish To Receive Emails Off Worcester Cars When A New Car Comes For Sale?</label><br>
                            </div>
                        </div>
        
                        <button type="submit"><a>Register</a></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
