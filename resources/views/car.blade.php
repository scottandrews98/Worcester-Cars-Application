@extends('layouts.app', ['title' => $individualCar[0] -> name])

@section('metaDescription')
<meta name="description" content="{{$individualCar[0] -> description}}" />
@endsection

@section('twitter')
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@WorcesterCars" />
    <meta name="twitter:title" content="{{$individualCar[0] -> name}}" />
    <meta name="twitter:description" content="{{$individualCar[0] -> description}}" />
    <meta name="twitter:image" content="{{asset('carImages/').'/'.$carImageURL[0]}}" />
@endsection

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>{{$individualCar[0] -> name}}</h1>
                </div> 
                <div class="col-sm">
                    <h2>£{{$individualCar[0] -> price}}</h2>
                </div> 
            </div>
        </div>
    </header>

    <section class="shareIcons">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 floatRight">
                    <!-- TODO place share icons and add car to favourites list if signed in -->
                    <button class="shareButton" id="facebook"><i class="fas fa-facebook-square"></i></button>
                    <button class="shareButton" id="twitter"><i class="fas fa-twitter-square"></i></button>

                    @if (Auth::check())
                        <button class="shareButton" data-carID="{{$id}}" id="star"><i class="fas fa-star"></i></button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="individualCars">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-responsive" src="{{asset('carImages/').'/'.$carImageURL[0]}}" alt="{{$carAltText[0]}}" />
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row individualStat">
                                <div class="col-sm-4">
                                    <div class="iconContiner">
                                        <i class="fas fa-tachometer-alt"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{$individualCar[0] -> mileage}} Miles</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row individualStat">
                                <div class="col-sm-4">
                                    <div class="iconContiner">
                                        <i class="fas fa-gas-pump"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{$individualCar[0] -> fuelTypeName}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row individualStat">
                                <div class="col-sm-4">
                                    <div class="iconContiner">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{$individualCar[0] -> transmissionType}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row individualStat">
                                <div class="col-sm-4">
                                    <div class="iconContiner">
                                        <i class="fas fa-tachometer-alt"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{$individualCar[0] -> topSpeed}} MPH</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row individualStat">
                                <div class="col-sm-4">
                                    <div class="iconContiner">
                                        <i class="fas fa-car"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{$individualCar[0] -> engineSize}} Litre</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row individualStat">
                                <div class="col-sm-4">
                                    <div class="iconContiner">
                                        <i class="fas fa-road"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p>£{{$individualCar[0] -> tax}} Tax</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row individualStat">
                                <div class="col-sm-4">
                                    <div class="iconContiner">
                                        <i class="fas fa-gas-pump"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{$individualCar[0] -> mpg}} MPG</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row individualStat">
                                <div class="col-sm-4">
                                    <div class="iconContiner">
                                        <i class="fas fa-door-open"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{$individualCar[0] -> totalDoors}} Door</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row individualStat">
                                <div class="col-sm-4">
                                    <div class="iconContiner">
                                        <i class="fas fa-chair"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{$individualCar[0] -> totalSeats}} Seats</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row individualStat">
                                <div class="col-sm-4">
                                    <div class="iconContiner">
                                        <i class="fas fa-car-side"></i>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <p>{{$individualCar[0] -> bodyTypeName}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- https://www.w3schools.com/bootstrap/bootstrap_tabs_pills.asp -->

    <section class="individualCarInformation">
        <div class="container">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link  active" href="#desciption" role="tab" data-toggle="tab" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery" role="tab" data-toggle="tab">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#finance" role="tab" data-toggle="tab">Finance Calculator</a>
                </li>
            </ul>
                    
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="desciption">
                    <!-- TODO Add in accesbility zoom feature -->
                    <div class="row">
                        <div class="col-sm-11">
                            <p id="carDescription">
                                {{$individualCar[0] -> description}}
                            </p>
                        </div>
                        <div class="col-sm-1">
                            <img id="increaseText" src="{{ asset('images/zoom-in.png') }}" >
                            <img id="decreaseText" src="{{ asset('images/zoom-out.png') }}" >
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="gallery">
                    <div class="row imageRow">
                        @foreach($carImageURL as $index => $imageLoop)
                            <a href="{{asset('carImages/').'/'.$carImageURL[$index]}}" data-lightbox="image-1"> 
                                <img src="{{asset('carImages/').'/'.$carImageURL[$index]}}" class="img-responsive" alt="{{$carAltText[$index]}}">
                            </a>
                        @endforeach
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="finance">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Price Of Car</label></br>
                            <input type="number" value="{{$individualCar[0] -> price}}" id="price" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label>Deposit</label></br>
                            <input type="number" value="" id="deposit">
                        </div>
                        <div class="col-sm-4">
                            <label>Repayment Term</label></br>
                            <select id="repayment">
                                <option value="12">12 Months</option>
                                <option value="24">24 Months</option>
                                <option value="36">36 Months</option>
                                <option value="48">48 Months</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button id="calculate">Calculate</button>
                            <h5 id="result"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection