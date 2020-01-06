@extends('layouts.app')

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
            <div class="topRow">
                <div class="row">
                    <div class="col-md-4">
                        <img class="img-responsive" src="assets/images/bmwFront.jpg" alt="BMW Front grill" />
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>BWM M3</h3>
                            </div>
                            <div class="col-sm-6">
                                <h4>£20,000</h4>
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
                                        <p>8000 Miles</p>
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
                                        <p>Manual</p>
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
                                        <p>3 Litre</p>
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
                                        <p>Petrol</p>
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
                                        <p>125 MPH</p>
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
                                        <p>£100 Tax</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="individualCar.html" class="loadCarButton">
                            <button class="loadCarButton">View Car</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
