<div id="remove">
    <!-- Price Row -->
    <div class="row compare">
        <div class="col-sm-8">
            <h5>Total Price</h5>
        </div>
        <div class="col-lg-2">
            <button id={{ ($compareDetails[0]->price < $compareDetails[1]->price) ? "secondButton" : "" }} >
                <a>Current: £{{ $compareDetails[0] -> price }}</a>
            </button>
        </div>
        <div class="col-lg-2">
            <button id={{ ($compareDetails[1]->price < $compareDetails[0]->price) ? "secondButton" : "" }}>
                <a>Compared: £{{ $compareDetails[1] -> price }}</a>
            </button>
        </div>
    </div>

    <!-- Miles Row -->
    <div class="row compare">
        <div class="col-sm-8">
            <h5>Total Miles</h5>
        </div>
        <div class="col-lg-2">
            <button id={{ ($compareDetails[0]->mileage < $compareDetails[1]->mileage) ? "secondButton" : "" }} >
                <a>Current: {{ $compareDetails[0] -> mileage }}</a>
            </button>
        </div>
        <div class="col-lg-2">
            <button id={{ ($compareDetails[1]->mileage < $compareDetails[0]->mileage) ? "secondButton" : "" }}>
                <a>Compared: {{ $compareDetails[1] -> mileage }}</a>
            </button>
        </div>
    </div>

    <!-- MPG Row -->
    <div class="row compare">
        <div class="col-sm-8">
            <h5>Miles Per Gallon</h5>
        </div>
        <div class="col-lg-2">
            <button id={{ ($compareDetails[0]->mpg > $compareDetails[1]->mpg) ? "secondButton" : "" }} >
                <a>Current: {{ $compareDetails[0] -> mpg }}</a>
            </button>
        </div>
        <div class="col-lg-2">
            <button id={{ ($compareDetails[1]->mpg > $compareDetails[0]->mpg) ? "secondButton" : "" }}>
                <a>Compared: {{ $compareDetails[1] -> mpg }}</a>
            </button>
        </div>
    </div>

    <!-- Tax Cost -->
    <div class="row compare">
        <div class="col-sm-8">
            <h5>Tax Cost Per Year</h5>
        </div>
        <div class="col-lg-2">
            <button id={{ ($compareDetails[0]->tax < $compareDetails[1]->tax) ? "secondButton" : "" }} >
                <a>Current: £{{ $compareDetails[0] -> tax }}</a>
            </button>
        </div>
        <div class="col-lg-2">
            <button id={{ ($compareDetails[1]->tax < $compareDetails[0]->tax) ? "secondButton" : "" }}>
                <a>Compared: £{{ $compareDetails[1] -> tax }}</a>
            </button>
        </div>
    </div>

    <!-- Total Seats -->
    <div class="row compare">
        <div class="col-sm-8">
            <h5>Total Seats</h5>
        </div>
        <div class="col-lg-2">
            <button>
                <a>Current: {{ $compareDetails[0] -> totalSeats }}</a>
            </button>
        </div>
        <div class="col-lg-2">
            <button>
                <a>Compared: {{ $compareDetails[1] -> totalSeats }}</a>
            </button>
        </div>
    </div>

    <!-- Button To View Compared Car -->
    <div class="row">
        <div class="col-sm-12">
            <button class="linkCar">
                <a href="/car/{{ $newID }}" target="_blank">View Compared Car</a>
            </button>
        </div>
    </div>
</div>