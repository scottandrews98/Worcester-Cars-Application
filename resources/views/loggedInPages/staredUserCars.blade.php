@extends('layouts.app', ['title' => 'Saved Cars'])

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>{{ $userInformation[0] -> name }}</h1>
                </div> 
                <div class="col-sm">
                    <a href="/settings">Back</a>
                </div> 
            </div>
        </div>
    </header>

    @if(count($likedCars) > 0)
        @foreach($likedCars as $index => $cars)
            <section class="cars">
                <div class="container">
                    <div class="topRow">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-responsive" src="{{asset('carImages/').'/'.$carImageURL[$index]}}" alt="{{$carAltText[$index]}}" />
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3>{{ $cars -> name }}</h3>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>£{{ $cars -> price }}</h4>
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
                                                <p>{{ $cars -> mileage }} Miles</p>
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
                                                <p>{{ $cars -> transmissionType }} </p>
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
                                                <p>{{ $cars -> engineSize }} Litre</p>
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
                                                <p>{{ $cars -> fuelTypeName }}</p>
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
                                                <p>{{ $cars -> topSpeed }} MPH</p>
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
                                                <p>£{{ $cars -> tax }} Tax</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="/car/{{ $cars -> id }}" class="loadCarButton">
                                    <button class="loadCarButton">View Car</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
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