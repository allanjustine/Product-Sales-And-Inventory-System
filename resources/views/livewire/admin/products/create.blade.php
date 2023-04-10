<div>
    <!-- Modal Add Product-->
    <div wire:ignore.self class="modal fade" id="addProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Add Product</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title">Product Image:</label>
                                    <input type="file" accept=".png, .jpg, .jpeg, .gif" class="form-control"
                                        id="create_product_image" wire:model="product_image" required>
                                    @if ($product_image && in_array($product_image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ $product_image->temporaryUrl() }}"
                                            style="width: 100px; height: 100px;" class="mt-1 rounded">
                                    @endif
                                    @error('product_image')
                                        <span class="text-danger">*{{ $message }} (jpg, jpeg, png, gif) is only
                                            accepted.</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="product-code">Product Code:</label>
                                    <input type="text" id="product-code" class="form-control" name="product_code"
                                        wire:model="product_code" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="product_name">Product Name:</label>
                                    <input type="text" class="form-control" id="product_name"
                                        placeholder="Product Name" wire:model.defer="product_name" required>
                                    @error('product_name')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="product_status">Product Status:</label>
                                    <select class="form-select" id="product_status" wire:model.defer="product_status"
                                        required>
                                        <option selected hidden="true">Select Product Status</option>
                                        <option disabled>Select Product Status</option>
                                        <option value="Available">Available</option>
                                        <option value="Not Available">Not Available</option>
                                    </select>
                                    @error('product_status')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="product_stock">Product Stock:</label>
                                    <input type="number" id="product_stock" placeholder="Product Stock"
                                        name="product Stock" wire:model.defer="product_stock" class="form-control"
                                        required>
                                    @error('product_stock')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="product_price">Product Price:</label>
                                    <input type="number" id="product_price" name="product_price"
                                        wire:model.defer="product_price" placeholder="Product Price"
                                        class="form-control" required>
                                    @error('product_price')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="product_category_id">Product Category:</label>
                                    <select class="form-select" id="product_category_id"
                                        wire:model.defer="product_category_id" required>
                                        <option selected hidden="true">Select Product Category</option>
                                        <option disabled>Select Product Category</option>
                                        @foreach ($product_categories as $product_category)
                                            <option value="{{ $product_category->id }}">
                                                {{ $product_category->category_name }}</option>
                                        @endforeach

                                    </select>
                                    @error('product_category_id')
                                        <span class="text-danger">*The product category field is required.</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="product_rating">Rating:</label>
                                    <select class="form-select" id="product_rating" wire:model.defer="product_rating"
                                        required>
                                        <option selected hidden="true">Select Rating</option>
                                        <option disabled>Select Product Rating</option>
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
                                    @error('product_rating')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="product_description">Description:</label>
                                    <textarea id="product_description" name="product_description" wire:model.defer="product_description"
                                        placeholder="Description" class="form-control" rows="5" required></textarea>
                                    @error('product_description')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="addProduct()">
                        <div wire:loading><svg class="loading"></svg></div>&nbsp; Add Product
                    </button>
                    <button class="btn btn-outline-warning" wire:click="resetInputs()">Reset Inputs</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        $('#addProduct').on('hidden.bs.modal', function() {
            Livewire.emit('resetInputs');
        });
    });
</script>
