<div>
    <!-- Modal Delete To Cart -->
    <div wire:ignore.self class="modal fade" id="checkOut" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Are you sure you want to place this item to order?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        @if ($cartItemToCheckOut)
                            <p class="text-center">
                                <img style="widht: 70px; height: 70px; border-radius: 50%;"
                                    src="{{ Storage::url($cartItemToCheckOut->product->product_image) }}"
                                    alt="{{ $cartItemToCheckOut->product->product_name }}">
                            </p>
                            <p class="text-center">
                                <strong>
                                    {{ $cartItemToCheckOut->product->product_name }}
                                </strong>
                            </p>
                            <p class="text-center">
                                <strong>
                                    {{ number_format($cartItemToCheckOut->quantity) }} PC(s)
                                </strong>
                            </p>
                            <p class="text-center">
                                <strong>
                                    &#8369;{{ number_format($cartItemToCheckOut->product->product_price, 2, '.', ',') }}
                                </strong>
                            </p>
                            <p class="text-center">
                                <strong>
                                    Total:
                                    &#8369;{{ number_format($cartItemToCheckOut->product->product_price * $cartItemToCheckOut->quantity, 2, '.', ',') }}
                                </strong>
                            </p>
                        @endif
                    </div>
                    <hr>
                    <p class="text-center">
                        <label for="order_payment_method">Payment Method</label>
                        <select id="select-cat" class="form-select" style="" name="order_payment_method"
                            id="order_payment_method" wire:model.defer="order_payment_method" required>
                            <option selected hidden="true">Select a Payment Method</option>
                            <option disabled>Select a Payment Method</option>
                            <option value="Cash On Delivery">Cash On Delivery</option>
                        </select>
                        @error('order_payment_method')
                            <span class="text-center text-danger">*Please select payment method first.</span>
                        @enderror
                        <br>
                        <label class="mt-3" for="user_location">Your delivery address</label>
                        <textarea name="" class="form-control {{ $errors->has('user_location') ? 'border-danger' : '' }}" id="" cols="20" rows="5"
                            placeholder="Enter specific location for the delivery" wire:model.defer="user_location"></textarea>
                            @if ($errors->has('user_location'))
                            <span class="text-red-500">*Please your delivery address first.</span>
                        @endif
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" wire:click="placeOrder()">Place Order
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        $('#checkOut').on('hidden.bs.modal', function() {
            Livewire.emit('resetInputs');
        });
    });
</script>
