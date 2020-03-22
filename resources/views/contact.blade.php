@extends('layouts.app', ['title' => 'Contact'])

@section('metaDescription')
<meta name="description" content="{{$contactPageMeta[0] -> contactPageMeta ?? '' }}" />
@endsection


@section('content')
    <!-- Header Section -->
    <header class="secondaryHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1>Contact</h1>
                </div> 
            </div>
        </div>
    </header>

    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="iframeContainer">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3117.548331322742!2d-2.240270075167197!3d52.18925705696547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870f0bf676ae42f%3A0x68835c28717b22b5!2s23%20Rowley%20Hill%20St%2C%20Worcester%20WR2%205LN!5e0!3m2!1sen!2suk!4v1571073057417!5m2!1sen!2suk" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
                <div class="col-md-6">
                    <form>
                        @csrf
                        <input type="text" id="name" placeholder="Name">
                        <input type="email" id="email" placeholder="Email">
                        <input type="number" id="phone" placeholder="Phone">
                        <textarea cols="40" rows="5" id="message" placeholder="Message"></textarea>
                        <button type="button" id="submitContactForm">Submit</button>
                    </form>
                    <div class="errorBox">
                        <h4 id="errorMessage"></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contactInfo">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h3>Visit Us</h3>

                    <p>23 Rowley Hill Street</p>
                    <p>Worcester</p>
                    <p>Worcestershire</p>
                    <p>WR2 5LN</p>
                </div>
            </div>
        </div>
    </section>
@endsection
