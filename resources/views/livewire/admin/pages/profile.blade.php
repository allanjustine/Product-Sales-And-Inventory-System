<div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card shadow">
                        <div class="card-body box-profile">
                            <div class="text-center profile-pic-div">
                                <div wire:loading wire:target="updatePhoto, profile_image">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ Storage::url('asset/loading.gif') }}" alt="loading"
                                        style="height: 150px; width: 150px; border-radius: 50%;">
                                </div>
                                <div wire:loading wire:target="updateProfile, changePassword">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ Auth::user()->profile_image === null ? Storage::url('asset/profile-pic.jpg') : Storage::url(Auth::user()->profile_image) }}"
                                        alt="loading" style="height: 150px; width: 150px; border-radius: 50%;">
                                </div>
                                <div wire:loading.remove>
                                    @if ($profile_image && in_array($profile_image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{ $profile_image->temporaryUrl() }}" alt="{{ $user->name }} photo"
                                            id="photo" style="height: 150px; width: 150px; border-radius: 50%;">
                                    @else
                                        @if (!$profile_image)
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ Auth::user()->profile_image === null ? Storage::url('asset/profile-pic.jpg') : Storage::url(Auth::user()->profile_image) }}"
                                                alt="{{ $user->name }} photo" id="photo"
                                                style="height: 150px; width: 150px; border-radius: 50%;">
                                        @endif
                                        @if ($profile_image)
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ Auth::user()->profile_image === null ? Storage::url('asset/profile-pic.jpg') : Storage::url(Auth::user()->profile_image) }}"
                                                alt="{{ $user->name }} photo" id="photo"
                                                style="height: 150px; width: 150px; border-radius: 50%;"><br>
                                            <span
                                                class="text-danger">*{{ $profile_image->getClientOriginalExtension() }}
                                                is not a valid image type. Only (jpg, jpeg, png, gif) are
                                                accepted.</span><br>
                                        @endif
                                    @endif
                                </div>
                                <form id="myform" wire:submit.prevent="updatePhoto" enctype="multipart/form-data">
                                    <div class="avatar-edit">
                                        <input type='file' id="profile_image" accept=".png, .jpg, .jpeg, .gif"
                                            wire:model="profile_image" wire:loading.attr="disabled" />
                                        <label for="profile_image"></label>
                                    </div>
                                    @if ($profile_image && in_array($profile_image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                        <button type="submit" class="btn btn-primary btn-sm mt-2">
                                            <span wire:loading.remove><i class="fa-solid fa-cloud-arrow-up"></i>Save
                                                Photo</span>
                                            <span wire:loading>Please wait...</span>
                                        </button>
                                    @endif
                                </form>
                            </div>
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>

                            <p class="text-muted text-center">
                                @if ($user->isAdmin())
                                    Admin
                                @else
                                    User
                                @endif
                            </p>
                            <hr>
                            <div class="mb-3">

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                                <p class="text-muted">{{ $user->address }}</p>

                                <hr>

                                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                                <p class="text-muted">{{ $user->email }}</p>

                                <hr>

                                <strong><i class="fas fa-phone mr-1"></i> Phone</strong>

                                <p class="text-muted">{{ $user->phone_number }}</p>

                            </div>

                            <a href="#" id="logout-btn" class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#logout"><i
                                    class="fa-solid fa-arrow-right-from-bracket mr-2"></i><b>Logout</b></a>

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card shadow">
                        <div class="card-header">

                            <h3 class="card-title p-2">
                                <i class="fa fa-circle-info mr-2"></i>
                                <strong>ABOUT ME</strong>
                            </h3>
                            <div class="card-tools mr-1">

                                <button type="button" id="save-btn" class="btn btn-outline-primary"
                                    wire:click="updateProfile()"><span class="fa fa-floppy-disk mr-2"></span>Save
                                    Changes</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" id="info-form">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" name="name"
                                            placeholder="Name" wire:model.defer="name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputAddress" name="address"
                                            placeholder="Address" wire:model.defer="address" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="phone" id="inputPhone"
                                            placeholder="Phone" wire:model.defer="phone_number" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="inputEmail"
                                            placeholder="Email" wire:model.defer="email" required>
                                    </div>
                                </div>
                            </form>
                            <hr>

                            <div class="row" style="justify-content: space-between;">
                                <h6 class="card-title heading-small text-muted mb-4 p-2">Change Password</h6>
                                <div class="card-tools mr-1">
                                    <button type="button" id="save-pass-btn" class="btn btn-outline-info btn-sm"
                                        wire:click="changePassword()"><span class="fa fa-floppy-disk mr-2"></span>Save
                                        Password</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="oldPassword" class="col-form-label">Old Password</label>
                                    <div class="">
                                        <input type="password" class="form-control" name="oldPass" id="oldPassword"
                                            placeholder="Old Password" wire:model.defer="oldPassword">
                                        @error('oldPassword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="password" class="col-form-label">New Password</label>
                                    <div class="">
                                        <input type="password" class="form-control" name="newpass" id="password"
                                            placeholder="New Password" wire:model.defer="password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="password_confirmation" class="col-form-label">Confirm Password</label>
                                    <div class="">
                                        <input type="password" class="form-control" name="cpass"
                                            id="password_confirmation" placeholder="Confirm Password"
                                            wire:model.defer="password_confirmation">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you sure you want to logout?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="float-right" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                After you logout you will redirect to login page.
            </div>
            <div class="modal-footer">
                <a href="/logout" class="btn btn-danger">Yes, Logout</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-pic-div .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
    }

    .profile-pic-div .avatar-edit input {
        display: none;
    }

    .profile-pic-div .avatar-edit input+label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .profile-pic-div .avatar-edit input+label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    .profile-pic-div .avatar-edit input+label:after {
        content: "\f040";
        font-family: 'FontAwesome';
        color: #757575;
        position: absolute;
        top: 10px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }
</style>