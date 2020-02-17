@extends('layouts.app', ['title' => 'Cars'])

@section('content')
     <!-- Header Section -->
     <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Cars</h1>
                </div> 
                <div class="col-sm-6">
                    <a href="#" id="advancedSearch">Advanced Search</a>
                </div> 
            </div>
        </div>
    </header>

    <!-- Advanced Search Box Dropdown -->
    <section class="searchBox">
        <div class="container">   
            <form>
                <div class="row">
                    <div class="col-sm-4">
                        <input type="text" placeholder="Name">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Miles">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Fuel Type">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <input type="text" placeholder="Transmition">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Engine Size">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Tax Cost">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button><a>Search</a></button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="cars">
        <div class="container">
            @foreach($allCars as $index => $cars)
                <div class="topRow">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- TODO implement solution for car uploaded without any images like a waiting for image image -->
                            <img class="img-responsive" src="{{asset('carImages/').'/'.$allCarImages[$index]->image}}" alt="{{$allCarImages[$index]->altText}}" />
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
            @endforeach
        </div>
    </section>
@endsection
