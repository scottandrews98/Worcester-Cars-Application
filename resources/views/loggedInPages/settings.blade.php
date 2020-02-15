@extends('layouts.app', ['title' => 'Settings'])

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Settings</h1>
                </div> 
                <div class="col-sm">
                    <a href="/logout">Sign Out</a>
                </div> 
            </div>
        </div>
    </header>

    <section class="individualCarInformation">
        <div class="container">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link  active" href="#settings" role="tab" data-toggle="tab" aria-selected="true">Site Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#googleAnalytics" role="tab" data-toggle="tab">Google Analytics</a>
                </li>
            </ul>
                    
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="settings">

                </div>
                <div role="tabpanel" class="tab-pane" id="googleAnalytics">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Last 7 Days</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>{{$pageViews}}</h3>
                            <h5>Total Page View</h5>
                        </div>
                        <div class="col-sm-6">
                            <h3>{{$visitors}}</h3>
                            <h5>Total Site Visitors</h5>
                        </div>
                    </div>
                    
                    

                    @foreach($mostVisitedPages as $pages)
                        <div class="row carsForSale">
                            <div class="col-sm-6">
                                <h5>{{ $pages['pageTitle'] }}</h5>
                            </div>
                            <div class="col-sm-3">
                                <button>
                                    {{ $pages['pageViews'] }} Views
                                </button>
                            </div>
                            <div class="col-sm-3">
                                <button id="secondButton">
                                    URL: {{ $pages['url'] }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection