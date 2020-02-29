@extends('layouts.app', ['title' => 'View User Profile'])

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>View User Profile</h1>
                </div> 
                <div class="col-sm">
                    <a href="/settings">Back</a>
                </div> 
            </div>
        </div>
    </header>

    <section class="individualCarInformation">
        <div class="container">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link  active" href="#settings" role="tab" data-toggle="tab" aria-selected="true">{{ $userInformation[0] -> name }}</a>
                </li>
            </ul>
                    
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="settings">
                <div class="row">
                        <form class="adminAddNew" id="addNew">
                            
                            <input type="text" placeholder="Name" name="name" value="{{ $userInformation[0] -> name }}" disabled>
                            <input type="email" placeholder="Email" name="email" value="{{ $userInformation[0] -> email }}" disabled>
                            <input type="number" placeholder="Phone" name="number" value="{{ $userInformation[0] -> number }}" disabled>

                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="checkbox" @if ($userInformation[0] -> consent_form_notifications == 1) checked="checked" @endif placeholder="Do You Wish To Revieve Email's Off Worcester Cars When A New Car Comes For Sale?" name="emailConsent" disabled>  
                                </div>
                                <div class="col-sm-10">
                                    <label for="emailConsent">Do You Wish To Revieve Email's Off Worcester Cars When A New Car Comes For Sale? </label><br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection