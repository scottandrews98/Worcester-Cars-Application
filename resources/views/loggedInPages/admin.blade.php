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
                        <form class="adminAddNew">
                            <input type="text" placeholder="Name Of Car">
                            <input type="text" placeholder="Make">
                            <input type="number" placeholder="Total Miles" class="halfWidth">
                            <input type="text" placeholder="Fuel Type" class="halfWidthRight">
                            <input type="text" placeholder="Engine Size" class="halfWidth">
                            <input type="number" placeholder="Miles Per Gallon" class="halfWidthRight">
                            <input type="text" placeholder="Gearbox" class="halfWidth">
                            <input type="number" placeholder="Top Speed" class="halfWidthRight">
                            <input type="text" placeholder="Tax Cost" class="halfWidth">
                            <input type="number" placeholder="Total Doors" class="halfWidthRight">
                            <input type="text" placeholder="Total Seats" class="halfWidth">
                            <input type="number" placeholder="Car Shape" class="halfWidthRight">
                            <textarea cols="40" rows="5" placeholder="Car Description"></textarea>

                            <!-- Car Pictures Section -->
                            <div class="row imageRow">
                                <img src="assets/images/bmwFront.jpg" class="img-responsive" alt="BMW Front grill">
                                <div class="addNewImage">
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>

                            <button type="submit" href="#">Add Car</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection