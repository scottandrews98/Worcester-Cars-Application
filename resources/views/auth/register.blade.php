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

                        <label for="name" style="font-size: 0px">Name</label>
                        <input type="text" placeholder="Name" name="name" value="{{ old('name') }}" id="name" required>

                        <label for="email" style="font-size: 0px">Email</label>
                        <input type="email" class="@error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" id="email" required>

                        <label for="phone" style="font-size: 0px">Phone Number</label>
                        <input type="number" placeholder="Phone" name="number" value="{{ old('number') }}" id="phone" required>

                        <label for="password" style="font-size: 0px">Password</label>
                        <input type="password" placeholder="Password (Must Be At Least 8 Characters)" class="@error('password') is-invalid @enderror" name="password" id="password" required>

                        <label for="confirmPassword" style="font-size: 0px">Confirm Password</label>
                        <input type="password" placeholder="Confirm Password" name="password_confirmation" id="confirmPassword" required>

                        <div class="row">
                            <div class="col-sm-2">
                                <input type="checkbox" placeholder="Do You Wish To Revieve Email's Off Worcester Cars When A New Car Comes For Sale?" name="emailConsent" id="emailConsent">  
                            </div>
                            <div class="col-sm-10">
                                <label for="emailConsent">Do You Wish To Receive Emails Off Worcester Cars When A New Car Comes For Sale?</label><br>
                            </div>
                        </div>

                        <button type="submit"><a>Register</a></button>

                        <a href="/google/redirect" role="button" style="text-transform:none">
                        <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                            Register With Google
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
