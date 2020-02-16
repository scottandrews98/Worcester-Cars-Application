@extends('layouts.app', ['title' => 'Edit'])

@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Edit</h1>
                </div> 
                <div class="col-sm">
                    <a href="/admin">Back</a>
                </div> 
            </div>
        </div>
    </header>

    <section class="individualCarInformation">
        <div class="container">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link  active" href="#edit" role="tab" data-toggle="tab" aria-selected="true">Edit {{$selectedCar[0] -> name}}</a>
                </li>
            </ul>
                    
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="edit">
                    <div class="row">
                        <form class="adminAddNew" id="addNew" method="POST" action="/admin/edit/{{$selectedCar[0] -> id}}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" placeholder="Name Of Car" name="name" value="{{$selectedCar[0] -> name}}" required>
                            
                            <input type="number" placeholder="Cost" name="cost" value="{{$selectedCar[0] -> price}}" required>

                            <input type="text" list="cars" placeholder="Make" name="make" value="{{$selectedCar[0] -> manufacturerName}}" required>
                            <datalist id="cars">
                                @foreach($allMakes as $make)
                                        <option>{{ $make -> manufacturerName }}</option>
                                @endforeach
                            </datalist>

                            <input type="number" placeholder="Total Miles" class="halfWidth" name="miles" value="{{$selectedCar[0] -> mileage}}" required>
                            <input type="text" list="fuel" placeholder="Fuel Type" class="halfWidthRight" value="{{$selectedCar[0] -> fuelTypeName}}" name="fuelType" required>
                            <datalist id="fuel">
                                @foreach($allFuelType as $fuel)
                                        <option>{{ $fuel -> fuelTypeName }}</option>
                                @endforeach
                            </datalist>

                            <input type="text" placeholder="Engine Size" class="halfWidth" name="engineSize" value="{{$selectedCar[0] -> engineSize}}" required>
                            <input type="number" placeholder="Miles Per Gallon" class="halfWidthRight" name="mpg" value="{{$selectedCar[0] -> mpg}}" required>
                            <input type="text" list="gearbox" placeholder="Gearbox" class="halfWidth" name="gearbox" value="{{$selectedCar[0] -> transmissionType}}" required>
                            <datalist id="gearbox">
                                @foreach($allTransmissionType as $transmission)
                                        <option>{{ $transmission -> transmissionType }}</option>
                                @endforeach
                            </datalist>

                            <input type="number" placeholder="Top Speed" class="halfWidthRight" name="topSpeed" value="{{$selectedCar[0] -> topSpeed}}" required>
                            <input type="number" placeholder="Tax Cost" class="halfWidth" name="taxCost" value="{{$selectedCar[0] -> tax}}" required>
                            <input type="number" placeholder="Total Doors" class="halfWidthRight" name="doors" value="{{$selectedCar[0] -> totalDoors}}" required>
                            <input type="number" placeholder="Total Seats" class="halfWidth" name="seats" value="{{$selectedCar[0] -> totalSeats}}" required>
                            <input type="text" list="carShape" placeholder="Car Shape" class="halfWidthRight" name="bodyType" value="{{$selectedCar[0] -> bodyTypeName}}" required>
                            <datalist id="carShape">
                                @foreach($allCarShapes as $shape)
                                        <option>{{ $shape -> bodyTypeName }}</option>
                                @endforeach
                            </datalist>

                            <textarea cols="40" rows="5" placeholder="Car Description" name="description" required>{{$selectedCar[0] -> description}}</textarea>

                            @foreach($carImages as $index => $imageLoop)
                                <input type="text" class="altText" data-imageID="{{$index}}" placeholder="Alt Text For Image Number {{$index}}" value="{{$imageLoop->altText}}" name="altText[]" required>
                            @endforeach

                            <!-- Car Pictures Section -->
                            <div class="row imageRow" id="imageRow">
                                @foreach($carImages as $index => $imageLoop)
                                    <img src="{{asset('carImages/').'/'.$imageLoop->image}}" data-imageID="{{$index}}" class="img-responsive imgUploaded" id="carImage1" alt="{{$imageLoop->altText}}">
                                @endforeach
                               
                                <!-- <img src="assets/images/bmwFront.jpg" class="img-responsive" id="carImage1" alt="BMW Front grill"> -->
                                <div class="addNewImage">
                                    <i class="fas fa-plus" id="addNewImage2"></i>
                                </div>
                            </div>
                            <!-- https://stackoverflow.com/questions/19721123/how-to-populate-input-type-file-value-from-database-in-php -->

                            <input class="fileid" type="file" name="image[]" accept="image/*" hidden/> 
                            @foreach($carImages as $index => $imageLoop)
                                <input class="fileid" type="file" name="image[]" data-imageID="{{$index}}" accept="image/*" hidden/>
                            @endforeach

                            <button type="submit" href="#">Update Car</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection