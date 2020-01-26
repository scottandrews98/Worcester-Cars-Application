@extends('layouts.app', ['title' => 'Home'])

@section('content')
    <!-- Header Section -->
    <header class="homeHeader">
        <div class="overlay"></div>
        <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
            <source src="{{ asset('video/homeBackground.mp4') }}" type="video/mp4">
        </video>
        <div class="container h-100 align-items-center">
            <div class="row headerTitle">
                <div class="col-sm">
                    <div class="text-white text-center center">
                        <h1>Worcester’s Best Used Car Center</h1>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm centerSelect">
                    <select class="makerDropdown">
                        <option value="" disabled selected>Pick Manufacturer</option>
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                </div>
                <div class="col-sm">
                    <div class="submitButton">
                        <p>Search</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Popular Brands Section -->
    <section class="popularBrands">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3>Top Selling Brands</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <h4>Mercedes</h4>
                </div>
                <div class="col-sm">
                    <h4>Ford</h4>
                </div>
                <div class="col-sm">
                    <h4>Vauxhall</h4>
                </div>
                <div class="col-sm">
                    <h4>Peugeot</h4>
                </div>
                <div class="col-sm">
                    <h4>Citroen</h4>
                </div>
                <div class="col-sm">
                    <h4>Toyota</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="secondSection">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="informationBox">
                        <div class="circle">
                            <i class="fas fa-car"></i>
                            <div class="textContainer">
                                <h4>The Best Deals In Worcester</h4>
                            </div>
                            <div class="submitButton">
                                <p>Discover</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="informationBox">
                        <div class="circle">
                            <i class="fas fa-tachometer-alt"></i>
                            <div class="textContainer">
                                <h4>You Can Drive Away The Same Day</h4>
                            </div>
                            <div class="submitButton">
                                <p>Visit Us</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="informationBox">
                        <div class="circle">
                            <i class="fas fa-thumbs-up"></i>
                            <div class="textContainer">
                                <h4>The Best Deals In Worcester</h4>
                            </div>
                            <div class="submitButton">
                                <p>Discover</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Black wedge that appears ontop of third section -->
    <div class="blackWedge"></div>

    <!-- Third Section -->
    <section class="thirdSection">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="textContainer">
                        <h3>Family Run Since 1976</h3>

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                            sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fourth Section in site -->
    <section class="fourthSection">
        <div class="container"> 
            <div class="row">
                <div class="col-sm-4  visitUs">
                    <h3>Visit Us</h3>

                    <p>23 Rowley Hill Street</p>
                    <p>Worcester</p>
                    <p>Worcestershire</p>
                    <p>WR2 5LN</p>
                </div>

                <div class="col-sm-8">
                    <div class="iframeContainer">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3117.548331322742!2d-2.240270075167197!3d52.18925705696547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870f0bf676ae42f%3A0x68835c28717b22b5!2s23%20Rowley%20Hill%20St%2C%20Worcester%20WR2%205LN!5e0!3m2!1sen!2suk!4v1571073057417!5m2!1sen!2suk" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
