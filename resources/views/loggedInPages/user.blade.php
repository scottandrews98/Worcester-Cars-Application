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

    @if(count($likedCars) > 0)
        <section class="cars">
            <div class="container">
                <div class="topRow">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- TODO implement solution for car uploaded without any images like a waiting for image image -->
                            <img class="img-responsive" src="{{asset('carImages/').'/'.$allCarImages[0]->image}}" alt="{{$allCarImages[0]->altText}}" />
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3>{{ $likedCars[0] -> name }}</h3>
                                </div>
                                <div class="col-sm-6">
                                    <h4>£{{ $likedCars[0] -> price }}</h4>
                                </div>
                            </div>
                            <div class="row firstRow">
                                <div class="col-md-4">
                                    <div class="row individualStat">
                                        <div class="col-sm-4">
                                            <div class="iconContiner">
                                                <i class="fas fa-tachometer-alt"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <p>{{ $likedCars[0] -> mileage }} Miles</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row individualStat">
                                        <div class="col-sm-4">
                                            <div class="iconContiner">
                                                <i class="fas fa-cogs"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <p>{{ $likedCars[0] -> transmissionType }} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row individualStat">
                                        <div class="col-sm-4">
                                            <div class="iconContiner">
                                                <i class="fas fa-car"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <p>{{ $likedCars[0] -> engineSize }} Litre</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row secondRow">
                                <div class="col-md-4">
                                    <div class="row individualStat">
                                        <div class="col-sm-4">
                                            <div class="iconContiner">
                                                <i class="fas fa-gas-pump"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <p>{{ $likedCars[0] -> fuelTypeName }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row individualStat">
                                        <div class="col-sm-4">
                                            <div class="iconContiner">
                                                <i class="fas fa-tachometer-alt"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <p>{{ $likedCars[0] -> topSpeed }} MPH</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row individualStat">
                                        <div class="col-sm-4">
                                            <div class="iconContiner">
                                                <i class="fas fa-road"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <p>£{{ $likedCars[0] -> tax }} Tax</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="/car/{{ $likedCars[0] -> id }}" class="loadCarButton">
                                <button class="loadCarButton">View Car</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="carsStared">
            <div class="container">
                <div class="col-md-12">
                    <h3>No Cars Currently Stared</h3>
                    <h5>All of our current stared cars will show up here</h5>
                </div>
            </div>
        </section>
    @endif
@endsection