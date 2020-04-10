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
                    <h1 id="mainCarsHeading">Cars{{ $brand }}</h1>
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
                        <label for="manufacturers" style="font-size: 0px">Manufacturers</label>
                        <select id="manufacturers" placeholder="Manufacturers">
                            <option>All Makes</option>
                            @foreach($allMakes as $make)
                                    <option>{{ $make -> manufacturerName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="miles" style="font-size: 0px">Maximum Car Miles</label>
                        <input id="miles" type="number" placeholder="Maximum Car Miles">
                    </div>
                    <div class="col-sm-4">
                        <label for="fuel" style="font-size: 0px">Fuel Type</label>
                        <select id="fuel">
                            <option>Any Fuel Type</option>
                            @foreach($allFuelType as $fuel)
                                    <option>{{ $fuel -> fuelTypeName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="gearbox" style="font-size: 0px">Transmission Type</label>
                        <select id="gearbox">
                            <option>All Transmission Types</option>
                            @foreach($allTransmissionType as $transmission)
                                    <option>{{ $transmission -> transmissionType }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="mpg" style="font-size: 0px">Minimum Miles Per Gallon</label>
                        <input id="mpg" type="number" placeholder="Minimum Miles Per Gallon">
                    </div>
                    <div class="col-sm-4">
                        <label for="tax" style="font-size: 0px">Minimum Tax Cost</label>
                        <input id="tax" type="number" placeholder="Maximum Tax Cost">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" id="search"><a href="#">Search</a></button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <label for="tax" style="font-size: 0px">Order By</label>
                <select id="orderBy">
                    <option>Lowest Price</option>
                    <option>Highest Price</option>
                    <option>Lowest Miles</option>
                </select>
            </div>
        </div>
    </div>

    <section class="cars" id="cars">
        <div class="container" id="remove">
            @foreach($allCars as $index => $cars)
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
            @endforeach

            <input hidden value="0" id="pageNumber">

            @if($totalSearch > 3)
                <div class="row">
                    <div class="col-sm">
                        <div class="buttonCenter">
                            <a id="nextPage" class="loadCarButton">
                                Next Page
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
