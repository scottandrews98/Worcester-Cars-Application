

<div class="container" id="remove">
    @if(count($carsSearch) > 0)
        @foreach($carsSearch as $index => $cars)
            <div class="topRow">
                <div class="row">
                    <div class="col-md-4">
                        <img class="img-responsive" src="{{asset('carImages/').'/'.$carImageURL[$index]}}" alt="{{$carAltText[$index]}}" />
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>{{ $cars -> name }}</h3>
                            </div>
                            <div class="col-sm-6">
                                <h4>£{{ $cars -> price }}</h4>
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
                                        <p>{{ $cars -> mileage }} Miles</p>
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
                                        <p>{{ $cars -> transmissionType }} </p>
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
                                        <p>{{ $cars -> engineSize }} Litre</p>
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
                                        <p>{{ $cars -> fuelTypeName }}</p>
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
                                        <p>{{ $cars -> topSpeed }} MPH</p>
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
                                        <p>£{{ $cars -> tax }} Tax</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="/car/{{ $cars -> id }}" class="loadCarButton">
                            <button class="loadCarButton">View Car</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <h3>No Cars Match Your Search Currently Avaliable</h3>
    @endif

    <input hidden value="{{ $pageNumber }}" id="pageNumber">
    <div class="row">
        <div class="col-sm">
            @if($pageNumber > 0)
                <div class="buttonCenter">
                    <a id="lastPage" class="loadCarButton">
                        Previous Page
                    </a>
                </div>
            @endif
        </div>
        <div class="col-sm">
            <div class="buttonCenter">
            @if($hideNext == false)
                <a id="nextPage" class="loadCarButton">
            @else
                <a id="nextPage" class="loadCarButton" style="display:none">
            @endif
                    Next Page
                </a>
            </div>
        </div>
    </div>
</div>

<!-- TODO Add in remove search parameters button -->