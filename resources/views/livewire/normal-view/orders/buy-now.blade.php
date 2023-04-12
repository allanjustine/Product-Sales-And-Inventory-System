<div>
    <!-- Modal Buy Now Info-->
    <div wire:ignore.self class="modal fade" id="toBuyNow" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Buy Now
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card w-100 shadow-none">
                            <div class="card-body">
                                <h5>Are you sure you want to buy this product and place it to order?</h5>

                                @if ($productToBuy)
                                    <div class="text-center">
                                        <img src="{{ Storage::url($productToBuy->product_image) }}"
                                            alt="{{ $productToBuy->product_name }}" class="img-fluid"
                                            style="width: 150px; height: 150px;">
                                        <h6 class="mt-5"><strong>{{ $productToBuy->product_name }}</strong></h6>
                                        <p><strong>&#8369;{{ number_format($productToBuy->product_price, 2, '.', ',') }}</strong>
                                        </p>
                                        <form>
                                            @csrf
                                            <p>
                                                <span><strong>Quantity:</strong><input type="number"
                                                        placeholder="Enter Quantity" wire:model.defer="order_quantity">
                                                    @error('order_quantity')
                                                        <span
                                                            class="text-center text-danger">*{{ $message }}</span><br>
                                                    @enderror
                                                </span>

                                                <span>
                                                    <label for="order_payment_method" class="mt-3">Payment
                                                        Method</label>
                                                    <select id="select-cat" class="form-select" style=""
                                                        name="order_payment_method" id="order_payment_method"
                                                        wire:model.defer="order_payment_method" required>
                                                        <option selected hidden="true">Select a Payment Method</option>
                                                        <option disabled>Select a Payment Method</option>
                                                        <option value="Cash On Delivery">Cash On Delivery</option>
                                                    </select>
                                                    @error('order_payment_method')
                                                        <span class="text-center text-danger">*Please select payment method
                                                            first.</span>
                                                    @enderror
                                                </span>
                                                <br>
                                                <span>
                                                    <label class="mt-3" for="user_location">Your delivery
                                                        address</label>
                                                    <textarea name="" class="form-control {{ $errors->has('user_location') ? 'border-danger' : '' }}" id=""
                                                        cols="20" rows="5" placeholder="Enter specific location for the delivery"
                                                        wire:model.defer="user_location"></textarea>
                                                    @if ($errors->has('user_location'))
                                                        <span class="text-danger">*Please enter your delivery address
                                                            first.</span>
                                                    @endif
                                                </span>

                                            </p>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="buyNowPlaceOrder()">Place Order</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        $('#toBuyNow').on('hidden.bs.modal', function() {
            Livewire.emit('resetInputs');
        });
    });
</script>
