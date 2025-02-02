@extends('layouts.app', ['title' => 'Admin'])

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Welcome {{ $name }}</h1>
                </div> 
                <div class="col-sm">
                    <a href="/logout">Sign Out</a>
                </div> 
            </div>
        </div>
    </header>

    <!-- Add or update confirmation message section -->
    <section class="addOrUpdateError">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(session()->has('success'))
                        <div class="card">
                            <div class="card-body bg-success">
                                {{ session()->get('success') }}
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
                    <a class="nav-link  active" href="#desciption" role="tab" data-toggle="tab" aria-selected="true">Current Cars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery" role="tab" data-toggle="tab">Add New</a>
                </li>
            </ul>
                    
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="desciption">
                    @foreach($allCars as $cars)
                        <div class="row carsForSale">
                            <div class="col-sm-6">
                                <h5>{{ $cars -> name }}</h5>
                            </div>
                            <div class="col-sm-3">
                                <button onclick="location.href='admin/edit/{{ $cars -> id }}';">
                                    <a href="admin/edit/{{ $cars -> id }}">Edit</a>
                                </button>
                            </div>
                            <div class="col-sm-3">
                                <button data-delete-id="{{ $cars -> id }}" id="secondButton">
                                    <a href="#" id="deleteCar">Delete</a>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div role="tabpanel" class="tab-pane" id="gallery">
                    <div class="row">
                        <form class="adminAddNew" id="addNew" method="POST" action="/admin/store/NULL" enctype="multipart/form-data">
                            @csrf
                            <input type="text" placeholder="Name Of Car" name="name" required>
                            
                            <input type="number" placeholder="Cost" name="cost" required>

                            <input type="text" list="cars" placeholder="Make" name="make" required>
                            <datalist id="cars">
                                @foreach($allMakes as $make)
                                        <option>{{ $make -> manufacturerName }}</option>
                                @endforeach
                            </datalist>

                            <input type="number" placeholder="Total Miles" class="halfWidth" name="miles" required>
                            <input type="text" list="fuel" placeholder="Fuel Type" class="halfWidthRight" name="fuelType" required>
                            <datalist id="fuel">
                                @foreach($allFuelType as $fuel)
                                        <option>{{ $fuel -> fuelTypeName }}</option>
                                @endforeach
                            </datalist>

                            <input type="text" placeholder="Engine Size" class="halfWidth" name="engineSize" required>
                            <input type="number" placeholder="Miles Per Gallon" class="halfWidthRight" name="mpg" required>
                            <input type="text" list="gearbox" placeholder="Gearbox" class="halfWidth" name="gearbox" required>
                            <datalist id="gearbox">
                                @foreach($allTransmissionType as $transmission)
                                        <option>{{ $transmission -> transmissionType }}</option>
                                @endforeach
                            </datalist>

                            <input type="number" placeholder="Top Speed" class="halfWidthRight" name="topSpeed" required>
                            <input type="number" placeholder="Tax Cost" class="halfWidth" name="taxCost" required>
                            <input type="number" placeholder="Total Doors" class="halfWidthRight" name="doors" required>
                            <input type="number" placeholder="Total Seats" class="halfWidth" name="seats" required>
                            <input type="text" list="carShape" placeholder="Car Shape" class="halfWidthRight" name="bodyType" required>
                            <datalist id="carShape">
                                @foreach($allCarShapes as $shape)
                                        <option>{{ $shape -> bodyTypeName }}</option>
                                @endforeach
                            </datalist>

                            <textarea cols="40" rows="5" placeholder="Car Description" name="description" required></textarea>

                            <!-- Car Pictures Section -->
                            <div class="row imageRow" id="imageRow">
                                <div class="addNewImage">
                                    <i class="fas fa-plus" id="addNewImage2"></i>
                                </div>
                            </div>

                            <input class="fileid" type="file" name="image[]" accept="image/*" hidden/>

                            <button id="submit" type="button" href="#">Add Car</button>
                            <button type="submit" id="hiddenSubmit" href="#" style="display: none"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection