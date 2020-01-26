@extends('layouts.app', ['title' => 'Admin'])

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Welcome Test Admin</h1>
                </div> 
                <div class="col-sm">
                    <a href="/home">Sign Out</a>
                </div> 
            </div>
        </div>
    </header>

    <section class="individualCarInformation">
        <div class="container">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link  active" href="#desciption" role="tab" data-toggle="tab" aria-selected="true">Current Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery" role="tab" data-toggle="tab">Add New</a>
                </li>
            </ul>
                    
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="desciption">
                    <div class="row carsForSale">
                        <div class="col-sm-6">
                            <h5>BMW M3</h5>
                        </div>
                        <div class="col-sm-3">
                            <button>
                                <a>Edit</a>
                            </button>
                        </div>
                        <div class="col-sm-3">
                            <button id="secondButton">
                                <a>Delete</a>
                            </button>
                        </div>
                    </div>
                    <div class="row carsForSale">
                        <div class="col-sm-6">
                            <h5>BMW M3</h5>
                        </div>
                        <div class="col-sm-3">
                            <button>
                                <a>Edit</a>
                            </button>
                        </div>
                        <div class="col-sm-3">
                            <button id="secondButton">
                                <a>Delete</a>
                            </button>
                        </div>
                    </div>
                    <div class="row carsForSale">
                        <div class="col-sm-6">
                            <h5>BMW M3</h5>
                        </div>
                        <div class="col-sm-3">
                            <button>
                                <a>Edit</a>
                            </button>
                        </div>
                        <div class="col-sm-3">
                            <button id="secondButton">
                                <a>Delete</a>
                            </button>
                        </div>
                    </div>
                    <div class="row carsForSale">
                        <div class="col-sm-6">
                            <h5>BMW M3</h5>
                        </div>
                        <div class="col-sm-3">
                            <button>
                                <a>Edit</a>
                            </button>
                        </div>
                        <div class="col-sm-3">
                            <button id="secondButton">
                                <a>Delete</a>
                            </button>
                        </div>
                    </div>
                    <div class="row carsForSale">
                        <div class="col-sm-6">
                            <h5>BMW M3</h5>
                        </div>
                        <div class="col-sm-3">
                            <button>
                                <a>Edit</a>
                            </button>
                        </div>
                        <div class="col-sm-3">
                            <button id="secondButton">
                                <a>Delete</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="gallery">
                    <div class="row">
                        <form class="adminAddNew" action="POST">
                            @csrf
                            <input type="text" placeholder="Name Of Car" name="name">

                            <input type="text" list="cars" placeholder="Make" name="make">
                            <datalist id="cars">
                                @foreach($allMakes as $make)
                                        <option>{{ $make -> manufacturerName }}</option>
                                @endforeach
                            </datalist>

                            <input type="number" placeholder="Total Miles" class="halfWidth" name="miles">
                            <input type="text" list="fuel" placeholder="Fuel Type" class="halfWidthRight" name="fuelType">
                            <datalist id="fuel">
                                @foreach($allFuelType as $fuel)
                                        <option>{{ $fuel -> fuelTypeName }}</option>
                                @endforeach
                            </datalist>

                            <input type="text" placeholder="Engine Size" class="halfWidth" name="engineSize">
                            <input type="number" placeholder="Miles Per Gallon" class="halfWidthRight" name="mpg">
                            <input type="text" list="gearbox" placeholder="Gearbox" class="halfWidth" name="gearbox">
                            <datalist id="gearbox">
                                @foreach($allTransmissionType as $transmission)
                                        <option>{{ $transmission -> transmissionType }}</option>
                                @endforeach
                            </datalist>

                            <input type="number" placeholder="Top Speed" class="halfWidthRight" name="topSpeed">
                            <input type="number" placeholder="Tax Cost" class="halfWidth" name="taxCost">
                            <input type="number" placeholder="Total Doors" class="halfWidthRight" name="doors">
                            <input type="number" placeholder="Total Seats" class="halfWidth" name="seats">
                            <input type="text" list="carShape" placeholder="Car Shape" class="halfWidthRight" name="bodyType">
                            <datalist id="carShape">
                                @foreach($allCarShapes as $shape)
                                        <option>{{ $shape -> bodyTypeName }}</option>
                                @endforeach
                            </datalist>

                            <textarea cols="40" rows="5" placeholder="Car Description" name="description"></textarea>

                            <!-- Car Pictures Section -->
                            <div class="row imageRow">
                                <img src="assets/images/bmwFront.jpg" class="img-responsive" alt="BMW Front grill">
                                <div class="addNewImage">
                                    <i class="fas fa-plus" id="addNewImage2"></i>
                                </div>
                            </div>

                            <input id='fileid' type='file' hidden/>

                            <button type="submit" href="#">Add Car</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection