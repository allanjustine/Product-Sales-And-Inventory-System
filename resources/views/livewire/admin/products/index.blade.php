<div>
    @include('livewire.admin.products.delete')
    @include('livewire.admin.products.edit')
    @include('livewire.admin.products.create')
    @include('livewire.admin.products.view')
    <div class="table-responsive card card-primary card-outline card-outline-tabs" id="product-table"
        style="height: 500px;">
        <div class="card-body">
            <div class="col-sm-12">
                <label>Show:</label>
                <select wire:model="perPage" class="perPageSelect">
                    <option>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
                <label>Entries</label>
                <button class="btn btn-primary mb-3 me-2 float-end" data-toggle="modal" data-target="#addProduct">
                    <i class="fa-solid fa-plus"></i> Add Product
                </button>
                <input type="search" class="form-control mb-3 mx-2 float-end" style="width: 198px;"
                    placeholder="Search" wire:model="search">
                <select name="product_category" id="product_category" class="form-select mb-3 float-end"
                    style="width: 180px;" wire:model="category_name">
                    <option value="All">All</option>
                    @foreach ($product_categories as $category)
                        <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <table class="table table-hovered table-bordered">
                <thead class="bg-dark">
                    <tr>
                        <th wire:click="sortBy('product_code')" style="cursor: pointer;">
                            @if ($sortBy === 'product_code')
                                @if ($sortDirection === 'asc')
                                    <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                            @else
                                <i class="fa-thin fa-sort"></i>
                            @endif
                            Product Code
                        </th>
                        <th>Product Image</th>
                        <th wire:click="sortBy('product_name')" style="cursor: pointer;">
                            @if ($sortBy === 'product_name')
                                @if ($sortDirection === 'asc')
                                    <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                            @else
                                <i class="fa-thin fa-sort"></i>
                            @endif
                            Product Name
                        </th>
                        <th wire:click="sortBy('product_stock')" style="cursor: pointer;">
                            @if ($sortBy === 'product_stock')
                                @if ($sortDirection === 'asc')
                                    <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                            @else
                                <i class="fa-thin fa-sort"></i>
                            @endif
                            Stock(s)
                        </th>
                        <th wire:click="sortBy('product_rating')" style="cursor: pointer;">
                            @if ($sortBy === 'product_rating')
                                @if ($sortDirection === 'asc')
                                    <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                            @else
                                <i class="fa-thin fa-sort"></i>
                            @endif
                            Rating(s)
                        </th>
                        <th wire:click="sortBy('product_price')" style="cursor: pointer;">
                            @if ($sortBy === 'product_price')
                                @if ($sortDirection === 'asc')
                                    <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                            @else
                                <i class="fa-thin fa-sort"></i>
                            @endif
                            Price
                        </th>
                        <th wire:click="sortBy('product_status')" style="cursor: pointer;">
                            @if ($sortBy === 'product_status')
                                @if ($sortDirection === 'asc')
                                    <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                            @else
                                <i class="fa-thin fa-sort"></i>
                            @endif
                            Status
                        </th>
                        <th wire:click="sortBy('product_category_id')" style="cursor: pointer;">
                            @if ($sortBy === 'product_category_id')
                                @if ($sortDirection === 'asc')
                                    <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                            @else
                                <i class="fa-thin fa-sort"></i>
                            @endif
                            Category
                        </th>
                        <th wire:click="sortBy('product_sold')" style="cursor: pointer;">
                            @if ($sortBy === 'product_sold')
                                @if ($sortDirection === 'asc')
                                    <i class="fa-light fa-sort-alpha-up"></i>
                                @else
                                    <i class="fa-light fa-arrow-down-z-a"></i>
                                @endif
                            @else
                                <i class="fa-thin fa-sort"></i>
                            @endif
                            Sold
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_code }}</td>
                            <td>
                                <img src="{{ Storage::url($product->product_image) }}"
                                    style="height: 50px; width: 60px; border-radius: 5px;"
                                    alt="{{ $product->product_name }}">
                            </td>
                            <td>{{ $product->product_name }}</td>
                            @if ($product->product_stock)
                                <td><span>{{ number_format($product->product_stock) }} PC(s)</span></td>
                            @else
                                <td><span class="badge badge-warning">OUT OF STOCK</span></td>
                            @endif
                            <td>{{ $product->product_rating }} <i class="fa-solid fa-star"></i></td>
                            <td>&#8369;{{ number_format($product->product_price, 2, '.', ',') }}</td>
                            @if ($product->product_status === 'Available')
                                <td><span class="badge badge-success">AVAILABLE</span></td>
                            @else
                                <td><span class="badge badge-danger">NOT AVAILABLE</span></td>
                            @endif
                            <td>{{ $product->product_category->category_name }}</td>
                            <td>x{{ $product->product_sold }}</td>
                            <td>
                                <div class="dropdown dropup">
                                    <span class="badge badge-pill badge-primary py-2" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i style="font-size: 18px; cursor: pointer;"
                                            class="fas fa-plus-circle fa-fw rounded-circle"></i>
                                    </span>
                                    <div class="dropdown-menu text-center p-2" aria-labelledby="dropdownMenuButton">
                                        <a href="" class="btn btn-warning mt-1 form-control" data-toggle="modal"
                                            data-target="#viewProduct" wire:click="view({{ $product->id }})"><i
                                                class="fa-solid fa-eye"></i> View</a>
                                        <a href="" class="btn btn-primary mt-1 form-control" data-toggle="modal"
                                            data-target="#updateProduct" wire:click="edit({{ $product->id }})"><i
                                                class="fa-light fa-pen-to-square"></i> Update</a>
                                        <a href="" class="btn btn-danger mt-1 form-control" data-toggle="modal"
                                            data-target="#deleteProduct" wire:click="delete({{ $product->id }})"><i
                                                class="fa-solid fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if (!empty($search) && $products->count() === 0)
                        <td colspan="9" class="text-center">
                            <h6>"{{ $search }}" not found.</h6>
                        </td>
                    @elseif($products->count() === 0)
                        <td colspan="9" class="text-center">
                            <h6>No data found.</h6>
                        </td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex align-items-center">
        <span class="me-auto p-1 rounded">Showing: <span class="p-1 rounded"
                style="border: 1px solid rgba(156, 154, 154, 0.356); background-color:rgba(150, 209, 248, 0.384);"><strong>{{ $products->firstItem() }}-{{ $products->lastItem() }}</strong>
                of
                <strong>{{ $products->total() }}</strong></span> Entries</span>
        <span class="ms-auto pt-3">
            {{ $products->links('pages.admin.layout.pagination') }}</span>
    </div>
</div>

<style>
    .role-name {
        text-transform: uppercase;
    }

    .perPageSelect {
        font-family: Arial, sans-serif;
        border: 1px solid #ccc;
        color: #333;
        width: 70px;
        padding: 10px;
        border-radius: 5px;
    }

    .perPageSelect:focus {
        outline: none;
    }
</style>
