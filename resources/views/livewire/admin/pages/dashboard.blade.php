<div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="info-box dash elevation-3" style="height: 110px;">
                    <div class="info-box-content">
                        <span class="info-box-text" style="font-size: 11px;">ADMINS</span>
                        <span class="info-box-number">{{ $adminsCount }}</span>
                    </div>
                    <span class="info-box-icon"><i class="fa-solid fa-user-lock" style="font-size: 43px;"></i></span>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <a href="/admin/users" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">USERS</span>
                            <span class="info-box-number">{{ $usersCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-users" style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <a href="/admin/products" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">PRODUCTS</span>
                            <span class="info-box-number">{{ $productsCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-box-open" style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <a href="/admin/product-categories" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">CATEGORIES</span>
                            <span class="info-box-number">{{ $categoriesCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-list" style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <a href="/admin/orders" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">ORDERS</span>
                            <span class="info-box-number">{{ $ordersCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-bag-shopping"
                                style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <a href="/admin/product-sales" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">PRODUCT SALES</span>
                            <span class="info-box-number">{{ $productSalesCount }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-database" style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h4>Revenue Sales Management </h4>
        <hr>
        <div class="row">
            <div class="col-md-4 col-lg-3 col-sm-6 col-6">
                <a href="#" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">TOTAL REVENUE</span>
                            <span class="info-box-number">&#8369;{{ number_format($grandTotal, 2, '.', ',') }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-hand-holding-dollar"
                                style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-6 col-6">
                <a href="#" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">TODAY REVENUE</span>
                            <span class="info-box-number">&#8369;{{ number_format($todaysTotal, 2, '.', ',') }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-calendar-day"
                                style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-6 col-6">
                <a href="#" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">
                                MONTHLY REVENUE
                            </span>
                            <span class="info-box-number">&#8369;{{ number_format($monthlyTotal, 2, '.', ',') }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-calendar-days"
                                style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-lg-3 col-sm-6 col-6">
                <a href="#" style="color: black">
                    <div class="info-box dash elevation-3" style="height: 110px;">
                        <div class="info-box-content">
                            <span class="info-box-text" style="font-size: 11px;">YEARLY REVENUE</span>
                            <span class="info-box-number">&#8369;{{ number_format($yearlyTotal, 2, '.', ',') }}</span>
                        </div>
                        <span class="info-box-icon"><i class="fa-solid fa-calendar"
                                style="font-size: 43px;"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div class="container mt-5">
        <h4>Net Worth Management </h4>
        <div class="row">
            <div class="col-md-6">
                <canvas id="net-worth-chart" style="width: 100%; height: 100%;"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="product-sales-chart" style="width: 100%; height: 100%;"></canvas>
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

<script>
    var salesData = {!! json_encode($salesData) !!};

    var ctx = document.getElementById('net-worth-chart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: salesData.map(data => `Month of ${data.month}`),
            datasets: [{
                label: 'Monthly Sales',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                data: salesData.map(data => data.sales),
                fill: true
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    var productSalesData = {!! json_encode($productSalesData) !!};

    var ctx = document.getElementById('product-sales-chart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: productSalesData.map(data => `Month of ${data.month}`),
            datasets: [{
                label: 'Monthly Product Sales',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'red',
                data: productSalesData.map(data => data.product_sales),
                fill: true
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
