<div>
    <!-- Modal Add User-->
    <div wire:ignore.self class="modal fade" id="addUser" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Add User</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="float-right" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Profile Image:</label>
                            <input type="file" accept=".png, .jpg, .jpeg, .gif" class="form-control"
                                id="create_profile_image" wire:model="profile_image" required>
                            @if ($profile_image && in_array($profile_image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ $profile_image->temporaryUrl() }}" style="width: 100px; height: 100px;"
                                    class="mt-1 rounded">
                            @endif
                            @error('profile_image')
                                <span class="text-danger">*{{ $message }} (jpg, jpeg, png, gif) is only
                                    accepted.</span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name"
                                        wire:model.defer="name" required>
                                    @error('name')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" placeholder="Address"
                                        wire:model.defer="address" required>
                                    @error('address')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password">Password:</label>
                                    <input type="password" id="password" placeholder="Password" name="password"
                                        wire:model.defer="password" class="form-control">
                                    @error('password')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password_confirmation">Confirm Password:</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        wire:model.defer="password_confirmation" placeholder="Confirm Password"
                                        class="form-control">
                                    @error('password_confirmation')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" placeholder="Email" id="email"
                                wire:model="email" required>
                            @error('email')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="phone_number">Phone Number:</label>
                                    <input type="number" class="form-control" id="phone_number"
                                        placeholder="Phone Number (09-xxxxxxxxx)" wire:model="phone_number" required>
                                    @error('phone_number')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="gender">Gender:</label>
                                    <select class="form-select" id="gender" wire:model.defer="gender" required>
                                        <option selected hidden="true">Select Gender</option>
                                        <option disabled>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="addUser()">
                        <div wire:loading><svg class="loading"></svg></div>&nbsp; <i class="fa-solid fa-plus"></i> Add User
                    </button>
                    <button class="btn btn-outline-warning" wire:click="resetInputs()"><i class="fa-solid fa-rotate"></i> Reset Inputs</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        $('#addUser').on('hidden.bs.modal', function() {
            Livewire.emit('resetInputs');
        });
    });
</script>
