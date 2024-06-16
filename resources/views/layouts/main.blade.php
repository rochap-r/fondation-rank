<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bienvenue sur le portail de la fondation RANK') </title>
    <link rel="icon" href="{{ asset('asset/img/logo-icon.png') }}">
    @yield('meta')

    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/slick.css') }}">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="{{ asset('asset/css/fontawesome.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('asset/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/odometer-theme.css') }}">
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/style-dark.css') }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('asset/css/responsive.css') }}">
    <!-- color -->
    <link rel="stylesheet" href="{{ asset('asset/css/color.css') }}">
    <style>
       
    </style>
    @stack('custom_css')
</head>

<body>
    <div class="preloader">
        <div class="sec-loading">
            <div class="one">
            </div>
        </div>
    </div>

    <!--including navbar-->
    @include('inc.navbar')
    <!--End navbar-->

    <!---->
    @yield('content')
    <!---->


    <!-- footer -->
    <footer class="footer-one" style="background-image: url(https://via.placeholder.com/1920x822);">
        <div class="footer-top-bar gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-md-6">
                        <div class="footer-logo-one">
                            <a href="{{ route('home') }}">
                                <p class="logo-text">
                                    <img src="{{ asset('asset/img/logo-rank-bg.png') }}" alt=""
                                        style="max-width: 120px">
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="widget-title">
                            <h3 class="m-0">Réseaux Sociaux</h3>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-6">
                        <ul class="social-media">
                            <li>
                                <a href="#">
                                    <i class="fab fa-facebook-f icon"></i>facebook</a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-whatsapp icon"></i>X</a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-instagram icon"></i>instagram</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="Information">
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="widget-title">
                                <h3 class="m-0">Information</h3>
                                <p class="pt-4">La Fondation Rank travaille sur l'éducation et le développement rural
                                    pour un avenir
                                    meilleur.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="widget-title">
                                <h3 class="m-0">Liens rapides</h3>
                                <ul class="pt-4">
                                    <li><i class="fa-solid fa-angle-right"></i><a href="/about">À propos de nous</a>
                                    </li>
                                    <li><i class="fa-solid fa-angle-right"></i><a href="/projects">Nos projets</a></li>
                                    <li><i class="fa-solid fa-angle-right"></i><a href="/events">Événements</a></li>
                                    <li><i class="fa-solid fa-angle-right"></i><a href="/partners">Nos partenaires</a>
                                    </li>
                                    <li><i class="fa-solid fa-angle-right"></i><a href="/blog">Actualités</a></li>
                                    <li><i class="fa-solid fa-angle-right"></i><a href="/contact">Contact</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="Information widget-title pt-0 pb-0">
                                <h3 class="m-0">Contact info</h3>

                                <div class="contact-info mt-4">
                                    <i>
                                        <svg height="512" viewBox="0 0 24 24" width="512"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="pin">
                                                <path
                                                    d="m12 22c-.3632813 0-.6972656-.1967773-.8740234-.5141602l-2.3066406-4.1518555c-2.897461-1.2597655-4.819336-4.1606445-4.819336-7.3339843 0-4.4111328 3.5888672-8 8-8s8 3.5888672 8 8c0 3.1733398-1.921875 6.0742188-4.8193359 7.3339844l-2.3066406 4.1518555c-.1767579.3173828-.5107422.5141601-.8740235.5141601zm0-18c-3.3085938 0-6 2.6914063-6 6 0 2.4736328 1.5576172 4.7265625 3.8769531 5.605957.2207031.0839844.4052734.2431641.5195313.4492188l1.6035156 2.8857422 1.6035156-2.8857422c.1142578-.2060547.2988281-.3652344.5195313-.4492188 2.3193359-.8793945 3.8769531-3.1323242 3.8769531-5.605957 0-3.3085937-2.6914062-6-6-6zm0 9c-1.6542969 0-3-1.3457031-3-3s1.3457031-3 3-3 3 1.3457031 3 3-1.3457031 3-3 3zm0-4c-.5517578 0-1 .4487305-1 1s.4482422 1 1 1 1-.4487305 1-1-.4482422-1-1-1z" />
                                            </g>
                                        </svg>
                                    </i>
                                    <h5>LUALABA, Ville:KOLWEZI, Commune:DILALA, Q/Mutoshi, N°:1309 Avenue Lumande</h5>
                                </div>
                                <div class="contact-info mt-3">
                                    <i>
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                            xml:space="preserve">
                                            <path d="M437.15,74.817C388.895,26.571,324.561,0,256,0C187.587,0,123.279,26.65,74.92,75.041
                        C26.559,123.435-0.048,187.766,0,256.184c0.048,68.507,27.005,132.938,75.905,181.425C124.335,485.629,188.219,512,255.997,512
                        c0.677,0,1.357-0.002,2.035-0.008c44.288-0.345,87.858-12.192,126.001-34.262l-15.024-25.967
                        c-33.653,19.472-72.109,29.925-111.21,30.23c-60.48,0.456-117.575-22.858-160.77-65.688C53.847,373.49,30.043,316.616,30,256.163
                        C29.958,195.762,53.447,138.97,96.141,96.247C138.832,53.527,195.605,30,256,30c124.595,0,225.979,101.365,226,225.959
                        c0.008,49.387-15.621,96.298-45.198,135.661c-2.573,3.424-6.37,5.478-10.692,5.784c-4.368,0.308-8.658-1.291-11.756-4.388
                        l-20.406-20.406l9.06-9.06l-70.711-70.711l-28.284,28.284c-58.885-7.935-105.202-54.252-113.137-113.137l28.284-28.284
                        l-70.711-70.711l-39.054,39.054c-3.826,66.249,19.552,133.776,70.167,184.391s118.142,73.993,184.391,70.167l8.782-8.781
                        l20.406,20.406c9.247,9.247,22.033,14.022,35.082,13.1c12.935-0.913,24.803-7.36,32.563-17.688
                        C494.3,365.039,512.01,311.895,512,255.954C511.988,187.393,485.406,123.064,437.15,74.817z" />
                                        </svg>
                                    </i>
                                    <h5>Tel:</h5><a href="callto:800-836-4620">+243 994 589 272</a>
                                </div>
                                <div class="contact-info mt-3">
                                    <i>
                                        <svg height="512" viewBox="0 0 32 32" width="512"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g data-name="Layer 34">
                                                <path
                                                    d="m30 9v14a3 3 0 0 1 -3 3h-22a3 3 0 0 1 -3-3v-14a2.87 2.87 0 0 1 .19-1l12.15 8.1a3 3 0 0 0 3.32 0l12.15-8.1a2.87 2.87 0 0 1 .19 1zm-13.45 5.43 12-8a3 3 0 0 0 -1.55-.43h-22a3 3 0 0 0 -1.54.44l12 8a1 1 0 0 0 1.09-.01z" />
                                            </g>
                                        </svg>
                                    </i>
                                    <h5>Email:</h5><a href="#">info@fondationrank.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bootom-bar">
            <div class="container">
                <div class="subscribe">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="ps-3 text-center">
                            <h3>Citation Inspirante</h3>
                            <p style="font-weight: bold;">"L'éducation est l'arme la plus puissante que vous pouvez
                                utiliser pour
                                changer le monde." - Nelson
                                Mandela</p>
                        </div>
                    </div>
                </div>

                <div class="wpo-lower-footer">
                    <p>© 2023 Fondation Rank <i class="fa-solid fa-heart px-2"></i> Tous droits réservés
                    </p>
                    <div class="d-flex align-items-center"><a href="#"> Conditions d'utilisation</a>
                        <div class="mx-4 boder"></div><a href="#">Politique de confidentialité</a>
                        <div class="mx-4 boder"></div> <a href="#"> Avertissement</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->
    <!-- Back to top button -->
    <a id="button"></a>
    <!-- Back to top button end -->
    <!-- jQuery -->
    <script src="{{ asset('asset/js/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap Js -->
    <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/js/slick.min.js') }}"></script>
    <script src="{{ asset('asset/js/circle-progres.js') }}"></script>
    <script src="{{ asset('asset/js/odometer.js') }}"></script>
    <script>
        setTimeout(function() {
            odometer.innerHTML = jQuery('.odometer1').data("id");
            odometer2.innerHTML = jQuery('.odometer2').data("id");
            odometer3.innerHTML = jQuery('.odometer3').data("id");
        }, 2000);
    </script>
    <script src="{{ asset('asset/js/custom.js') }}"></script>
    @stack('custom_js')
</body>

</html>
