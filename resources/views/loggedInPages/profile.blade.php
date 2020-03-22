@extends('layouts.app', ['title' => 'Profile'])

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Profile</h1>
                </div> 
                <div class="col-sm">
                    <a href="/logout">Sign Out</a>
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
                    @if(session()->has('message'))
                        <div class="card bg-success">
                            <div class="card-body">
                                Profile Updated
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="individualCarInformation">
        <div class="container">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link  active" href="#settings" role="tab" data-toggle="tab" aria-selected="true">Update Your Information</a>
                </li>
            </ul>
                    
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="settings">
                    <div class="row">
                        <form class="adminAddNew" id="messageChat" method="POST" action="/profile">
                            @csrf
                            <input type="text" placeholder="Name" name="name" value="{{ $userProfileData[0] -> name }}" required>
                            <input type="email" placeholder="Email" name="email" value="{{ $userProfileData[0] -> email }}" required>
                            <input type="number" placeholder="Phone" name="number" value="{{ $userProfileData[0] -> number }}" required>
                            <input type="password" autocomplete="new-password" placeholder="Password (Must Be At Least 8 Characters)" class="@error('password') is-invalid @enderror" name="password">
                            <input type="password" autocomplete="new-password" placeholder="Confirm Password" name="password_confirmation">

                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="checkbox" @if ($userProfileData[0] -> consent_form_notifications == 1) checked="checked" @endif placeholder="Do You Wish To Revieve Email's Off Worcester Cars When A New Car Comes For Sale?" name="emailConsent">  
                                </div>
                                <div class="col-sm-10">
                                    <label for="emailConsent">Do You Wish To Revieve Email's Off Worcester Cars When A New Car Comes For Sale? </label><br>
                                </div>
                            </div>

                            <button id="updateProfile" type="submit" href="#">Update Profile</button>
                        </form>

                        <!-- Option to remove profile -->
                        <button id="deleteProfile" type="button" href="#">Delete Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection