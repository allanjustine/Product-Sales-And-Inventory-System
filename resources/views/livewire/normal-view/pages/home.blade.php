<div>
    @include('livewire.normal-view.products.view')
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
                        <a href="#" class="btn" id="view-btn" data-toggle="tooltip" data-placement="bottom"
                            title="Have a nice day, {{ auth()->user()->name }}">Have a nice day,
                            {{ auth()->user()->name }}</a>
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

    <h3 class="text-center bg-dark mt-3 p-3"><i class="fa-sharp fa-regular fa-arrow-down fa-bounce"></i> TOP PRODUCTS <i
            class="fa-sharp fa-regular fa-arrow-down fa-bounce"></i></h3>

    <div class="container mt-3">
        <div class="card p-3 bg-transparent">
            <div class="grid">
                @foreach ($topDeals as $product)
                    <div class="grid-item col-md-3 col-sm-4 col-6">
                        <div class="card shadow product show" id="product-card" style="min-width: 50px;">
                            <div class="px-2" style="position: relative;">
                                <div class="image-container">
                                    <img class="card-img-top mt-4" src="{{ Storage::url($product->product_image) }}"
                                        alt="{{ $product->product_name }}">
                                </div>

                                <div class="pt-2 pr-2" style="position: absolute; top:0; right: 0;">
                                    @if ($loop->index == 0)
                                        <span class="px-2 pt-2 pb-1 rounded top-deals-bg">
                                            <i class="fa-solid fa-medal fa-flip top-deals-icon"></i>
                                            <span class="top-deals"><strong>Top 1</strong></span>
                                        </span>
                                    @else
                                        <span class="px-2 pt-2 pb-1 rounded top-deals-bg">
                                            <i class="fa-solid fa-medal fa-flip top-deals-icon"></i>
                                            <span class="top-deals"><strong>Top
                                                    {{ $loop->index + 1 }}</strong></span>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div class="card-footer text-center py-4 mt-auto">
                                <h6 class="d-inline-block text-secondary medium font-weight-medium mb-1">
                                    {{ $product->product_category->category_name }}</h6>
                                <h3 class="font-size-1 font-weight-normal">
                                    <h5>{{ $product->product_name }}</h5>
                                </h3>
                                <div class="d-block font-size-1">
                                    <span class="font-weight-medium"><i
                                            class="fas fa-peso-sign"></i>{{ number_format($product->product_price, 2, '.', ',') }}</span>
                                </div>
                                <a href="" class="btn btn-outline-info mt-1 form-control" data-toggle="modal"
                                    data-target="#viewProduct" wire:click="view({{ $product->id }})"><i
                                        class="fa-solid fa-eye"></i> View</a>
                            </div>
                            <div class="d-flex font-size-1 mb-2">
                                <strong class="pl-2" style="position: absolute; bottom:0; left: 0;">Sold:

                                    {{ $product->product_sold }}
                                </strong>
                                <span class="font-weight-medium pr-2" style="position: absolute; bottom:0; right: 0;">
                                    <i class="fa-solid fa-star"></i>
                                    <strong>
                                        {{ $product->product_rating }}/5
                                    </strong>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($topDeals->count() === 0)
                <p class="text-center">
                    <i class="fa-regular fa-xmark-to-slot" style="font-size: 50px;"></i>
                    <br>
                    No Popular Products Yet.
                </p>
            @endif
        </div>
    </div>

    <h3 class="text-center bg-dark mt-3 p-3"><i class="fa-sharp fa-regular fa-arrow-down fa-bounce"></i> POPULAR
        PRODUCTS <i class="fa-sharp fa-regular fa-arrow-down fa-bounce"></i></h3>

    <div class="container mt-3">
        <div class="card p-3 bg-transparent">
            <div class="grid">
                @foreach ($popularityDeals as $product)
                    <div class="grid-item col-md-3 col-sm-4 col-6">
                        <div class="card shadow product show" id="product-card" style="min-width: 50px;">
                            <div class="px-2" style="position: relative;">
                                <div class="image-container">
                                    <img class="card-img-top mt-4" src="{{ Storage::url($product->product_image) }}"
                                        alt="{{ $product->product_name }}">
                                </div>

                                <div class="pt-2 pr-2" style="position: absolute; top:0; right: 0;">
                                    @if ($loop->index == 0)
                                        <span class="px-2 pt-2 pb-1 rounded top-popular-bg">
                                            <i class="fa-solid fa-fire-flame-curved fa-beat top-popular-icon"></i>
                                            <span class="top-popular"><strong>Top 1</strong></span>
                                        </span>
                                    @else
                                        <span class="px-2 pt-2 pb-1 rounded top-popular-bg">
                                            <i class="fa-solid fa-fire-flame-curved fa-beat top-popular-icon"></i>
                                            <span class="top-popular"><strong>Top
                                                    {{ $loop->index + 1 }}</strong></span>
                                        </span>
                                    @endif
                                </div>

                            </div>
                            <div class="card-footer text-center py-4 mt-auto">
                                <h6 class="d-inline-block text-secondary medium font-weight-medium mb-1">
                                    {{ $product->product_category->category_name }}</h6>
                                <h3 class="font-size-1 font-weight-normal">
                                    <h5>{{ $product->product_name }}</h5>
                                </h3>
                                <div class="d-block font-size-1">
                                    <span class="font-weight-medium"><i
                                            class="fas fa-peso-sign"></i>{{ number_format($product->product_price, 2, '.', ',') }}</span>
                                </div>
                                <a href="" class="btn btn-outline-info mt-1 form-control" data-toggle="modal"
                                    data-target="#viewProduct" wire:click="view({{ $product->id }})"><i
                                        class="fa-solid fa-eye"></i> View</a>
                            </div>
                            <div class="d-flex font-size-1 mb-2">
                                <strong class="pl-2" style="position: absolute; bottom:0; left: 0;">Sold:

                                    {{ $product->product_sold }}
                                </strong>
                                <span class="font-weight-medium pr-2" style="position: absolute; bottom:0; right: 0;">
                                    <i class="fa-solid fa-star"></i>
                                    <strong>
                                        {{ $product->product_rating }}/5
                                    </strong>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($popularityDeals->count() === 0)
                <p class="text-center">
                    <i class="fa-regular fa-xmark-to-slot" style="font-size: 50px;"></i>
                    <br>
                    No Popular Products Yet.
                </p>
            @endif
        </div>
    </div>

    <h3 class="text-center bg-dark mt-3 p-3"><i class="fa-sharp fa-regular fa-arrow-down fa-bounce"></i> LOCATION <i
            class="fa-sharp fa-regular fa-arrow-down fa-bounce"></i></h3>
    <h4 class="text-center mt-4"><span class="location-text pb-2"><i class="fa-solid fa-location-dot fa-shake fa-xl"
                style="color: #ad0000;"></i> AJM Restaurant is located @Tinangnan, Tubigon,
            Bohol <i class="fa-solid fa-location-dot fa-shake fa-xl" style="color: #ad0000;"></i></span></h4>
    <div class="container d-flex justify-content-center mt-5 mb-3">
        <iframe class="elevation-3 rounded"
            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d413.07098686836446!2d123.970567480301!3d9.949291019306209!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zOcKwNTYnNTcuMCJOIDEyM8KwNTgnMTMuOCJF!5e0!3m2!1sen!2sph!4v1681485598511!5m2!1sen!2sph"
            width="700" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>
    </div>

</div>


<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
