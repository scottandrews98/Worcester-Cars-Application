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

    <!-- Displays a message if the settings section has updated -->
    <section class="registerError">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('message'))
                        <div class="card bg-success">
                            <div class="card-body">
                                Site Settings Updated
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
                    <a class="nav-link  active" href="#settings" role="tab" data-toggle="tab" aria-selected="true">Site Settings {{ $lastUpdate ?? ''}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#googleAnalytics" role="tab" data-toggle="tab">Google Analytics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#userManagement" role="tab" data-toggle="tab">User Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#formEntries" role="tab" data-toggle="tab">Contact Form Entries</a>
                </li>
            </ul>
                    
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="settings">
                <div class="row">
                        <form class="adminAddNew" id="addNew" method="POST" action="/settings">
                            @csrf
                            <input type="text" placeholder="Site Title" name="siteTitle" value="{{$siteSettingsData[0] -> siteTitle ?? ''}}" required>
                            
                            <textarea cols="40" rows="5" placeholder="Home Page Meta" name="homePageMeta">{{$siteSettingsData[0] -> homePageMeta ?? ''}}</textarea>

                            <textarea cols="40" rows="5" placeholder="About Page Meta" name="aboutPageMeta">{{$siteSettingsData[0] -> aboutPageMeta ?? ''}}</textarea>

                            <textarea cols="40" rows="5" placeholder="Cars Page Meta" name="carsPageMeta">{{$siteSettingsData[0] -> carsPageMeta ?? ''}}</textarea>

                            <textarea cols="40" rows="5" placeholder="Contact Page Meta" name="contactPageMeta">{{$siteSettingsData[0] -> contactPageMeta ?? ''}}</textarea>

                            <input type="number" placeholder="Finance Interest Rate" min="0" step="0.01" name="interestRate" value="{{$siteSettingsData[0] -> interestRate ?? ''}}">

                            <button type="submit" href="#">Update Settings</button>
                        </form>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="googleAnalytics">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Last 7 Days</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>{{$pageViews}} : Total Page Views</h3>
                        </div>
                        <div class="col-sm-6">
                            <h3>{{$visitors}} : Total Site Visitors</h3>
                        </div>
                    </div>
                    
                    @foreach($mostVisitedPages as $pages)
                        <div class="row carsForSale">
                            <div class="col-sm-6">
                                <h5>{{ $pages['pageTitle'] }}</h5>
                            </div>
                            <div class="col-lg-3">
                                <button>
                                    {{ $pages['pageViews'] }} Views
                                </button>
                            </div>
                            <div class="col-lg-3">
                                <button id="secondButton">
                                    URL: {{ $pages['url'] }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div role="tabpanel" class="tab-pane" id="userManagement">
                    @foreach($siteUserData as $users)
                        <div class="row carsForSale">
                            <div class="col-sm-6">
                                <h5>{{ $users -> name }}</h5>
                            </div>
                            <div class="col-sm-2">
                                <button>
                                    <a href="/viewProfile/{{ $users -> id }}">View Profile</a>
                                </button>
                            </div>
                            <div class="col-sm-2">
                                <button>
                                    @if($users -> userLevel_id == 2)
                                        <a href="#" id="makeAdmin" data-user-id="{{ $users -> id }}">Make Admin</a>
                                    @else
                                        <a href="#" id="removeAdmin" data-user-id="{{ $users -> id }}">Remove Admin</a>
                                    @endif
                                </button>
                            </div>
                            <div class="col-sm-2">
                                <button id="secondButton" class="staredButton" data-stared-user-id="{{ $users -> id }}">
                                    <a href="/viewStared/{{ $users -> id }}">View Stared Cars</a>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div role="tabpanel" class="tab-pane" id="formEntries">
                    @forelse($formSubmissionData as $submissions)
                        <div class="row carsForSale">
                            <div class="col-sm-8">
                                <h5>{{ $submissions -> name }}</h5>
                            </div>
                            <div class="col-sm-2">
                                <button id="secondButton">
                                    <a id="deleteMessage" data-message-id="{{ $submissions -> id }}" href="#">Delete Message</a>
                                </button>
                            </div>
                            <div class="col-sm-2">
                                <button>
                                    <a href="/viewMessage/{{ $submissions -> id }}">View Message</a>
                                </button>
                            </div>
                        </div>
                        @empty
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>Sorry No Messages</h5>
                                </div>
                            </div>
                        @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection