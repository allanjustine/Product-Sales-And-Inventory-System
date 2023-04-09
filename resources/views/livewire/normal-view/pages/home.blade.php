<div>
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/slide1.jpg" alt="First slide">
                <div class="carousel-caption text-center top-0">
                    <h3 id="car-title" class="py-3">Food is not just fuel, it's information. It talks to your DNA and
                        tells it what to do.</h3>
                    @if (auth()->check())
                        <a href="#" class="btn" id="view-btn">Have a nice day, {{ auth()->user()->name }}</a>
                        <a href="/products" class="btn btn-primary mt-1">Order now</a>
                    @else
                        <a href="/view-products" class="btn" id="view-btn">View Products</a>
                        <a href="/login" class="btn btn-primary">Get Started</a>
                    @endif
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/slide2.jpg" alt="Second slide">
                <div class="carousel-caption text-center top-0">
                    <h3 id="car-title" class="py-3">A restaurant should be a place where you can eat food that has
                        been cooked with passion, served with warmth, and enjoyed with pleasure.</h3>
                    @if (auth()->check())
                        <a href="#" class="btn" id="view-btn">Have a nice day, {{ auth()->user()->name }}</a>
                        <a href="/products" class="btn btn-primary mt-1">Order now</a>
                    @else
                        <a href="/view-products" class="btn" id="view-btn">View Products</a>
                        <a href="/login" class="btn btn-primary">Get Started</a>
                    @endif
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/slide3.jpg" alt="Third slide">
                <div class="carousel-caption text-center top-0">
                    <h3 id="car-title" class="py-3">Food delivery is not just a service, it's a relationship between
                        the restaurant and the customer.</h3>
                    @if (auth()->check())
                        <a href="#" class="btn" id="view-btn">Have a nice day, {{ auth()->user()->name }}</a>
                        <a href="/products" class="btn btn-primary mt-1">Order now</a>
                    @else
                        <a href="/view-products" class="btn" id="view-btn">View Products</a>
                        <a href="/login" class="btn btn-primary">Get Started</a>
                    @endif
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <h3 class="text-center bg-dark mt-3 p-3"><i class="fa-sharp fa-regular fa-arrow-down"></i> TOP DEALS <i
            class="fa-sharp fa-regular fa-arrow-down"></i></h3>

    <div class="container mt-3">


    </div>

    <h3 class="text-center bg-dark mt-3 p-3"><i class="fa-sharp fa-regular fa-arrow-down"></i> POPULAR PRODUCT <i
            class="fa-sharp fa-regular fa-arrow-down"></i></h3>

    <div class="container mt-3">

    </div>

    <h3 class="text-center bg-dark mt-3 p-3"><i class="fa-sharp fa-regular fa-arrow-down"></i> LOCATION <i
            class="fa-sharp fa-regular fa-arrow-down"></i></h3>
</div>
