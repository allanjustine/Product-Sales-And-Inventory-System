<div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box dash elevation-3" style="height: 110px;">
                    <div class="info-box-content">
                        <span class="info-box-text">ADMINS</span>
                        <span class="info-box-number">{{ $adminsCount }}</span>
                    </div>
                    <span class="info-box-icon"><i class="fa-solid fa-user-lock" style="font-size: 55px;"></i></span>
                </div>
            </div>
            <div class="col-md-3">
                <a href="/admin/users" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text">USERS</span>
                            <span class="info-box-number">{{ $usersCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-users" style="font-size: 55px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="/admin/products" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text">PRODUCTS</span>
                            <span class="info-box-number">{{ $productsCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-box-open" style="font-size: 55px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="/admin/product-categories" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text">CATEGORIES</span>
                            <span class="info-box-number">{{ $categoriesCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-list" style="font-size: 55px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="/admin/orders" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text">ORDERS</span>
                            <span class="info-box-number">{{ $ordersCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-bag-shopping" style="font-size: 55px;"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<style>
    .dash {
        border-left: 8px solid #343a40;
        border-right-color: #343a40;
        transition: transform 1.05s ease;
    }

    .dark-mode .info-box.dash {
        border-color: white !important;
    }

    .dash:hover {
        transform: scale(1.03);
        background-color: #343a400a;
    }
</style>

{{-- show me a code of how to have a forgot password in laravel livewire and after clicking the forgot password it will redirect to forgot password page and after request for the email and after inputing the existing email it will send to the email the new password --}}
