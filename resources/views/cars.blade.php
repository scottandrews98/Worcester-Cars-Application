@extends('layouts.app', ['title' => 'Cars'])

@section('metaDescription')
<meta name="description" content="{{$carsPageMeta[0] -> carsPageMeta ?? ''}}" />
@endsection

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
            <form id="searchForm">
                <div class="row">
                    <div class="col-sm-4">
                        <!-- <input type="text" list="manufacturers" placeholder="Manufacturers"> -->
                        <select id="manufacturers" placeholder="Manufacturers">
                            @foreach($allMakes as $make)
                                    <option>{{ $make -> manufacturerName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input id="miles" type="number" placeholder="Miles">
                    </div>
                    <div class="col-sm-4">
                        <!-- <input type="text" list="fuel" placeholder="Fuel Type"> -->
                        <select id="fuel">
                            @foreach($allFuelType as $fuel)
                                    <option>{{ $fuel -> fuelTypeName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <!-- <input type="text" list="gearbox" placeholder="Transmition"> -->
                        <select id="gearbox">
                            @foreach($allTransmissionType as $transmission)
                                    <option>{{ $transmission -> transmissionType }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input id="mpg" type="number" placeholder="Average Miles Per Gallon">
                    </div>
                    <div class="col-sm-4">
                        <input id="tax" type="number" placeholder="Tax Cost">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button"><a href="#" id="search">Search</a></button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="cars" id="cars">
        <div class="container" id="remove">
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

            <!-- TODO implement page 2 link here -->
            <a href="/cars/2" class="loadCarButton">
                <button class="loadCarButton">Next Page</button>
            </a>
        </div>
    </section>
@endsection
