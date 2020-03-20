@extends('layouts.app', ['title' => 'Message'])

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Message From {{ $messageInformation[0] -> name }}</h1>
                </div> 
                <div class="col-sm">
                    <a href="/settings">Back</a>
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
                    <a class="nav-link  active" href="#settings" role="tab" data-toggle="tab" aria-selected="true">{{ $messageTime }}</a>
                </li>
            </ul>
                    
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="settings">

                <div class="row">
                    <div class="col-sm-4">
                        <h5>{{ $messageInformation[0] -> name }}</h5>
                        <h5>{{ $messageInformation[0] -> email }}</h5>
                        <h5>{{ $messageInformation[0] -> number }}</h5>
                    </div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6">
                        <p>{{ $messageInformation[0] -> message }}</p>
                    </div>
                </div>

                <!-- Show Any Replies To Message Here -->
                @foreach($messageReplies as $replies)
                    <div class="row">
                        <div class="col-sm-8">
                            <p>{{ $replies -> messageReply }}</p>
                        </div>
                        <div class="col-sm-4">
                            <h5>{{ $replies -> name }}</h5>
                        </div>
                    </div>
                @endforeach

                <!-- HTML for replying to message -->
                <div class="row">
                    <form class="adminAddNew" id="addNew" method="POST" action="/viewMessage">
                        @csrf
                        
                        <input type="text" placeholder="Reply Message" name="message" required>
                        <input type="text" name="messageID" value="{{ $messageInformation[0] -> id }}" required hidden>

                        <button type="submit" href="#">Send Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection