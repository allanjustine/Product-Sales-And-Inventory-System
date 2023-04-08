<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css">


    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11.0.13/dist/sweetalert2.min.css">

    <!-- Include SweetAlert2 JS -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11.0.13/dist/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="{{ url('images/logo.png') }}">
    <title>My Web @yield('title')</title>
    @livewireStyles

    @include('pages.normal-view.layout.navbar')
</head>

<body style="overflow-x: hidden;">
    @yield('content')

    @include('sweetalert::alert')

    @livewireScripts

</body>

<footer class="bg-dark text-light py-4" onload="updateTime()">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>AJM Company</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore
                    et dolore magna aliqua.</p>
            </div>

            <div class="col-md-4">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt"></i> Address: Tinangnan, Tubigon, Bohol - Purok 2</li>
                    <li><i class="fas fa-phone"></i> Phone: 09512072888</li>
                    <li><i class="fas fa-envelope"></i> Email: mydummy.2022.2023@gmail.com</li>
                </ul>
            </div>

            <div class="col-md-4 text-center">
                <h5>Follow Us</h5>
                <ul class="list-inline social-icons">
                    <li class="list-inline-item">
                        <a href="https://facebook.com/1down" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://twitter.com" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://youtube.com" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://gmail.com" target="_blank">
                            <i class="fab fa-google"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://instagram.com" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="text-center mt-3">Current date and time: <span class="border-bottom"><span id="date"></span>
                        <span id="time"></span></span></p>
                <hr>
                <p>&copy; 2023 <strong>AJM</strong>. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<div class="back-to-top">
    <a id="button" class="btn" href="#">
        <i class="fas fa-arrow-up"></i>
    </a>
</div>
<script>
    window.addEventListener('scroll', function() {
        var backToTopButton = document.querySelector('.back-to-top');

        if (backToTopButton) {
            if (window.scrollY > 400) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        }
    });

    document.addEventListener('livewire:load', function() {
        Livewire.on('backToTop', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>

<script>
    function updateTime() {
        var now = new Date();
        var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var monthsOfYear = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
            "October", "November", "December"
        ];
        var dayOfWeek = daysOfWeek[now.getDay()];
        var month = monthsOfYear[now.getMonth()];
        var dayOfMonth = now.getDate();
        var year = now.getFullYear();
        var dateString = dayOfWeek + " - " + month + " " + dayOfMonth + ", " + year;
        var timeString = now.toLocaleTimeString();
        document.getElementById("date").innerHTML = dateString;
        document.getElementById("time").innerHTML = timeString;
    }
    setInterval(updateTime, 1000);
</script>

</html>
