@extends('layouts.app', ['title' => 'About'])

@section('metaDescription')
<meta name="description" content="{{$aboutPageMeta[0] -> aboutPageMeta ?? '' }}" />
@endsection

@section('content')
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>About</h1>
                </div> 
            </div>
        </div>
    </header>

    <section class="aboutInfo">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
                <div class="col-md-6">
                    <img class="img-responsive" src="{{ URL::to('/') }}/images/bmwFront.jpg" alt="BMW Front grill" />
                </div>
            </div>
        </div>
    </section>

    <section class="aboutInfo">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-responsive" src="{{ URL::to('/') }}/images/bmwBack.jpg" alt="BMW Front grill" />
                </div>
                <div class="col-md-6">
                    <div class="textAlignRight">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
