<div>
    @include('livewire.normal-view.products.view')
    <div style="backdrop-filter: blur(15px);" class="bg-transparent p-2 rounded sticky-top" id="cats">
        <div class="col-md-5 offset-md-4 mt-2">
            <input type="search" class="form-control" placeholder="Search" wire:model="search"
                style="border-radius: 30px; height: 50px;">
        </div>
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-1 text-center">
                <label>Show</label>
                <select wire:model="perPage" class="perPageSelect form-select" id="select-cat">
                    <option>15</option>
                    <option>20</option>
                    <option>25</option>
                    <option>35</option>
                    <option>45</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
            <div class="col-md-3 text-center">
                <label for="category">Categories</label>
                <select name="category" id="select-cat" class="form-select" wire:model="category_name">
                    <option value="All">All</option>
                    @foreach ($product_categories as $category)
                        <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 text-center">
                <label for="sort">Sort By</label>
                <select wire:model="sort" class="form-select" id="select-cat">
                    <option value="low_to_high">Price: Low to High</option>
                    <option value="high_to_low">Price: High to Low</option>
                </select>
            </div>
            <div class="col-md-3 text-center">
                <label for="sort">Ratings</label>
                <select wire:model="product_rating" class="form-select" id="select-cat">
                    <option value="All">All</option>
                    <option value="1">1
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= 1)
                                &#9733;
                            @else
                                &#9734;
                            @endif
                        @endfor
                    </option>
                    <option value="2">2
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= 2)
                                &#9733;
                            @else
                                &#9734;
                            @endif
                        @endfor
                    </option>
                    <option value="3">3
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= 3)
                                &#9733;
                            @else
                                &#9734;
                            @endif
                        @endfor
                    </option>
                    <option value="4">4
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= 4)
                                &#9733;
                            @else
                                &#9734;
                            @endif
                        @endfor
                    </option>
                    <option value="5">5
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= 5)
                                &#9733;
                            @else
                                &#9734;
                            @endif
                        @endfor
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h1>Products</h1>
        <hr>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-3">
                    <div class="card shadow product show" id="product-card" style="min-width: 50px;">
                        <div class="p-2" style="position: relative;">
                            <div class="image-container">
                                <img class="card-img-top mt-4" src="{{ Storage::url($product->product_image) }}"
                                    alt="{{ $product->product_name }}">
                            </div>

                            <div class="pt-3 pr-3" style="position: absolute; top:0; right: 0;">
                                @if ($product->product_stock >= 20)
                                    <span
                                        class="badge badge-success badge-pill">{{ number_format($product->product_stock) }}</span>
                                @elseif ($product->product_stock)
                                    <span
                                        class="badge badge-warning badge-pill">{{ number_format($product->product_stock) }}</span>
                                @else
                                    <span class="badge badge-danger badge-pill">OUT OF STOCK</span>
                                @endif
                            </div>

                        </div>
                        <div class="card-footer text-center py-4 mt-auto">
                            <h6 class="d-inline-block text-secondary medium font-weight-medium mb-1">
                                {{ $product->product_category->category_name }}</h6>
                            <h3 class="font-size-1 font-weight-normal">
                                <h5>{{ $product->product_name }}</h5>
                            </h3>
                            <div class="d-block font-size-1 mb-2">
                                <span class="font-weight-medium"><i
                                        class="fas fa-peso-sign"></i>{{ number_format($product->product_price, 2, '.', ',') }}</span>
                            </div>
                            <div class="d-block font-size-1 mb-2">
                                <span class="font-weight-medium">
                                    @if ($product->product_status === 'Available')
                                        <td><span class="badge badge-success">AVAILABLE</span></td>
                                    @else
                                        <td><span class="badge badge-danger">NOT AVAILABLE</span></td>
                                    @endif
                                </span>
                            </div>
                            <a href="" class="btn btn-outline-info mt-1 form-control" data-toggle="modal"
                                data-target="#viewProduct" wire:click="view({{ $product->id }})"><i
                                    class="fa-solid fa-eye"></i> View</a>
                            <a href="/login" class="btn btn-primary mt-1 form-control"><i
                                    class="fa-solid fa-cart-shopping"></i> Buy Now</a>

                            <div class="d-block font-size-1 mb-2">
                                <span class="font-weight-medium pr-2" style="position: absolute; bottom:0; right: 0;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $product->product_rating)
                                            <i class="fa-solid fa-star"></i>
                                        @else
                                            <i class="fa-light fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if (!empty($search) && $products->count() === 0)
                <span class="text-center">
                    <i class="fa-regular fa-face-thinking mb-3 mt-5" style="font-size: 100px;"></i>
                    <h4>"{{ $search }}" product not found.</h4>
                </span>
            @elseif($products->count() === 0)
                <span class="text-center">
                    <i class="fa-regular fa-xmark-to-slot mb-3 mt-5" style="font-size: 100px;"></i>
                    <h4>No products found comeback soon.</h4>
                </span>
            @endif
        </div>
    </div>
    <div class="d-flex align-items-center">
        <span class="mx-auto pt-3" id="paginate">
            {{ $products->links('pages.normal-view.layout.pagination') }}</span>
    </div>
</div>
