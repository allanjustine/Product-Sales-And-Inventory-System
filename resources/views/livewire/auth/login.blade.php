<div>
    @include('livewire.auth.forgot-password')
    @livewire('auth.resend-email')
    <div class="container mb-5">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="card-img-top d-flex justify-content-center align-items-center mb-3">
                <div class="overflow-hidden" style="width: 150px; height: 150px;">
                    <img src="images/mylogo.jpg" class="w-100 h-100" alt="Login Image">
                </div>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center">Login &nbsp;
                        <span class="position-relative">
                            <span style="cursor: pointer;"
                                class="position-absolute bottom-0 translate-middle badge rounded-pill bg-dark"
                                id="login-pill">
                                <i class="fa-solid fa-question" data-toggle="tooltip" data-placement="top"
                                    title="Login to continue the website"></i>
                            </span>
                        </span>
                    </h3>
                    <hr>
                    <form wire:submit.prevent="login">

                        <div class="form-floating mt-3">
                            <input type="email" id="email" wire:model.defer="email" class="form-control"
                                placeholder="Email">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        </div>

                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="password" id="password" wire:model.defer="password" class="form-control"
                                placeholder="Password">
                            <label for="password"><i class="fas fa-key"></i> Password</label>
                            <button type="button"
                                class="position-absolute no-focus top-50 end-0 mr-2 translate-middle-y"
                                onclick="togglePasswordVisibility()">
                                <i id="password-toggle-icon" class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="d-flex mt-3">
                            <div class="flex-grow-1">
                                <a href="" class="float-end" data-toggle="modal"
                                    data-target="#forgotPassword">Forgot password?</a>
                                <p><input type="checkbox" wire:model.defer="remember"> Remember me</p>
                                <p>Don't have an account? <a href="/register">Register</a></p>
                                <p>Didn't receive email verification? <a href="#" data-toggle="modal"
                                        data-target="#resend">Resend</a></p>
                            </div>
                        </div>
                        <button type="submit" class="mt-3 btn btn-primary form-control">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .no-focus:focus {
        outline: none;
    }

    .no-focus {
        border: none;
        background: transparent;
        font-size: 18px;
    }
</style>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var passwordToggleIcon = document.getElementById("password-toggle-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordToggleIcon.classList.remove("fa-eye-slash");
            passwordToggleIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            passwordToggleIcon.classList.remove("fa-eye");
            passwordToggleIcon.classList.add("fa-eye-slash");
        }
    }
</script>
