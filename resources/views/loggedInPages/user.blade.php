@extends('layouts.app', ['title' => 'Saved Cars'])

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Welcome Test</h1>
                </div> 
                <div class="col-sm">
                    <a href="/logout">Sign Out</a>
                </div> 
            </div>
        </div>
    </header>

    <section class="carsStared">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>No Cars Currently Stared</h3>
                    <h5>All of our current stared cars will show up here</h5>
                </div>
            </div>
        </div>
    </section>
@endsection
