<nav class="navbar navbar-expand-lg navbar-light bg-dark shadow">
    <h1 class="ms-5">
        <strong id="branding-ajm">AJM</strong>
    </h1>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mx-auto p-3">
            <li class="nav-item p-2">
                <a class="nav-link text-white text-center {{ '/' == request()->path() ? 'active2' : '' }}"
                    href="/"><i class="fa-light fa-house"></i> Home</a>
            </li>
            <li class="nav-item p-2">
                <a class="nav-link text-white text-center {{ 'about-us' == request()->path() ? 'active2' : '' }}"
                    href="/about-us"><i class="fa-light fa-question"></i> About Us</a>
            </li>
            <li class="nav-item p-2">
                <a class="nav-link text-white text-center {{ 'contact-us' == request()->path() ? 'active2' : '' }}"
                    href="/contact-us"><i class="fa-light fa-users"></i> Contact Us</a>
            </li>
            @if (auth()->check())
                <li class="nav-item p-2">
                    <a class="nav-link text-white text-center {{ 'products' == request()->path() ? 'active2' : '' }}"
                        href="/products"><i class="fa-light fa-box-open"></i> Products</a>
                </li>
            @else
                <li class="nav-item p-2">
                    <a class="nav-link text-white text-center {{ 'view-products' == request()->path() ? 'active2' : '' }}"
                        href="/view-products"><i class="fa-light fa-box-open"></i> View Products</a>
                </li>
            @endif
        </ul>
        <div class="dropdown me-5">
            <a class="nav-link text-white text-center profile-dropdown ms-5" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (auth()->check())
                    <div class="outline mx-auto"
                        style="width: 48px; height: 50px; border-radius: 50%; border: 2px solid white;">
                        <img style="width: 45px; height: 45px; border-radius: 50%;"
                            src="{{ auth()->user()->profile_image === null ? Storage::url('asset/profile-pic.jpg') : Storage::url(auth()->user()->profile_image) }}"
                            alt="{{ auth()->user()->name }}">
                    </div>
                @else
                    <h6>
                        <i class="fa-light fa-hand-wave"></i> Welcome, Visitors
                    </h6>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right" id="dropdown-setting" aria-labelledby="dropdownMenuButton">
                @if (auth()->check())
                    <a class="nav-link" href="/profile">
                        <div class="d-flex flex-column align-items-center">
                            <div class="mr-3 outline mb-3"
                                style="width: 45px; height: 46px; border-radius: 50%; border: 2px solid white;">
                                <img style="width: 41px; height: 41px; border-radius: 50%;"
                                    src="{{ auth()->user()->profile_image === null ? Storage::url('asset/profile-pic.jpg') : Storage::url(auth()->user()->profile_image) }}"
                                    alt="{{ auth()->user()->name }}">
                            </div>
                            <div class="text-center">
                                <span>{{ auth()->user()->name }}</span><br>
                                <span>{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    @role('admin')
                        <a class="nav-link p-3" href="/admin/dashboard"><i
                                class="fa-light fa-user-lock col-sm-1"></i>&nbsp;&nbsp;&nbsp;
                            <span>Admin Dashboard</span></a>
                        <div class="dropdown-divider"></div>
                    @endrole
                    <a class="nav-link p-3" href="/orders">
                        <i class="fa-light fa-bag-shopping"></i>&nbsp;
                        <span>My Orders</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link p-3" href="#" data-toggle="modal" data-target="#logout"><i
                            class="fa-light fa-right-from-bracket"></i>&nbsp;
                        <span>Logout</span></a>
                @else
                    <a class="nav-link p-3" href="/login"><i class="fa-light fa-right-to-bracket col-sm-1"></i>&nbsp;
                        <span>Login</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link p-3" href="/register"><i class="fa-light fa-registered col-sm-1"></i>&nbsp;
                        <span>Register</span></a>
                @endif
            </div>
        </div>
    </div>
</nav>

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
