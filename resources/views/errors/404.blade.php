@extends('layouts.app', ['title' => '404 Page Not Found'])

@section('content')
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Sorry No Page Here</h1>
                </div> 
            </div>
        </div>
    </header>

    <section class="ErrorPage">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Sorry It Appears You Got Lost, Use The Button Below To Return To The Home Page</h2>
                    <div class="homeButton">
                        <a href="/">Home</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
