<!--Including main layouts-->
@extends('layouts.main')

@section('title', 'Bienvenue sur le portail de la fondation RANK')
@section('meta')
@endsection
@push('custom_css')
@endpush
@section('content')

    <!-- slides-->
    <section class="slider-home-1 owl-carousel owl-theme">
        @foreach ($events as $event)
            <div class="slides item"
                style="background-image: url({{ asset('storage/events/thumbnails/banner_' . $event->image->name) }})">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="home-life">
                                <h1>{{ \Str::ucfirst(words($event->title, 8)) }}</h1>
                                <h4>{!! \Str::ucfirst(words($event->content, 15)) !!}</h4>
                                @if ($event->readable)
                                    <a href="donation-page.html" class="btn"><span>Decouvrez plus</span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </section>

    <!-- participation à la fondation-->
    <section class="what-we-provide gap no-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div style="background-color:#fdd65b" class="volunteer">
                        <i>
                            <svg version="1.1" id="svg3060" xml:space="preserve" width="682.66669" height="682.66669"
                                viewBox="0 0 682.66669 682.66669" xmlns="http://www.w3.org/2000/svg">
                                <defs id="defs3064">
                                    <clipPath clipPathUnits="userSpaceOnUse" id="clipPath3074">
                                        <path d="M 0,512 H 512 V 0 H 0 Z" id="path3072" />
                                    </clipPath>
                                </defs>
                                <g id="g3066" transform="matrix(1.3333333,0,0,-1.3333333,0,682.66667)">
                                    <g id="g3068">
                                        <g id="g3070" clip-path="url(#clipPath3074)">
                                            <g id="g3076" transform="translate(189.7695,76.1875)">
                                                <path
                                                    d="m 0,0 h -109.51 c -29.099,0 -36.636,9.638 -30.034,39.43 13.231,59.639 41.537,124.268 143.794,139.177 v 47.565 M 264.894,66.273 C 267.727,57.344 270.021,48.33 272.005,39.43 278.607,9.638 271.07,0 241.972,0 H 132.461 m -4.222,226.343 v -47.736 c 39.979,-5.838 68.654,-19.274 89.564,-37.047"
                                                    style="fill:none;stroke:#fff;stroke-width:20.148;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path3078" />
                                            </g>
                                            <g id="g3080" transform="translate(353.7373,404.1221)">
                                                <path
                                                    d="m 0,0 v -34.781 c 0,-44.786 -62.221,-99.664 -97.836,-99.664 -35.588,0 -97.837,54.878 -97.837,99.664 V 0 c 0,53.828 44.03,97.878 97.837,97.878 C -44.03,97.878 0,53.828 0,0 Z"
                                                    style="fill:none;stroke:#fff;stroke-width:20.148;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path3082" />
                                            </g>
                                            <g id="g3084" transform="translate(193.9912,254.7949)">
                                                <path d="M 0,0 61.995,-39.627 123.989,0"
                                                    style="fill:none;stroke:#fff;stroke-width:20.148;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path3086" />
                                            </g>
                                            <g id="g3088" transform="translate(255.9858,215.168)">
                                                <path d="m 0,0 -51.482,-35.404 -50.407,65.592"
                                                    style="fill:none;stroke:#fff;stroke-width:20.148;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path3090" />
                                            </g>
                                            <g id="g3092" transform="translate(158.064,402.2227)">
                                                <path
                                                    d="m 0,0 c 35.757,35.659 61.569,-6.123 97.837,-6.123 36.267,0 62.108,41.782 97.836,6.123"
                                                    style="fill:none;stroke:#fff;stroke-width:20.148;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path3094" />
                                            </g>
                                            <g id="g3096" transform="translate(256.0142,10)">
                                                <path
                                                    d="m 0,0 -60.011,57.939 c -16.49,17.092 -16.49,45.07 0,62.163 14.393,14.938 38.251,12.954 53.324,-1.163 6.885,-6.434 6.489,-6.434 13.346,0 15.101,14.117 38.93,16.101 53.324,1.163 16.49,-17.093 16.49,-45.071 0,-62.163 z"
                                                    style="fill:none;stroke:#fff;stroke-width:20.148;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path3098" />
                                            </g>
                                            <g id="g3100" transform="translate(255.9858,215.168)">
                                                <path d="m 0,0 51.511,-35.404 50.406,65.592"
                                                    style="fill:none;stroke:#fff;stroke-width:20.148;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path3102" />
                                            </g>
                                            <g id="g3104" transform="translate(436.501,183.5049)">
                                                <path d="M 0,0 V -0.028"
                                                    style="fill:none;stroke:#fff;stroke-width:20.148;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path3106" />
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </i>
                        <h3>Bénévolat</h3>
                        <p>Rejoignez-nous pour un avenir meilleur. Votre temps et vos compétences peuvent faire une
                            différence
                            significative.</p>
                        <a href="contact.html">Inscrivez-vous maintenant</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div style="background-color:#ff3636" class="volunteer donation">
                        <i>
                            <svg version="1.1" id="svg1605" xml:space="preserve" width="682.66669" height="682.66669"
                                viewBox="0 0 682.66669 682.66669" xmlns="http://www.w3.org/2000/svg">
                                <defs id="defs1609">
                                    <clipPath clipPathUnits="userSpaceOnUse" id="clipPath1619">
                                        <path d="M 0,512 H 512 V 0 H 0 Z" id="path1617" />
                                    </clipPath>
                                </defs>
                                <g id="g1611" transform="matrix(1.3333333,0,0,-1.3333333,0,682.66667)">
                                    <g id="g1613">
                                        <g id="g1615" clip-path="url(#clipPath1619)">
                                            <g id="g1621" transform="translate(256,256)">
                                                <path d="m 0,0 -60,-90 h -186 l 60,90 z"
                                                    style="fill:none;stroke:#000000;stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path1623" />
                                            </g>
                                            <g id="g1625" transform="translate(70,166)">
                                                <path d="M 0,0 V -156 H 372 V 0"
                                                    style="fill:none;stroke:#000000;stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path1627" />
                                            </g>
                                            <g id="g1629" transform="translate(256,10)">
                                                <path d="M 0,0 V 246"
                                                    style="fill:none;stroke:#000000;stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path1631" />
                                            </g>
                                            <g id="g1633" transform="translate(196,352)">
                                                <path
                                                    d="m 0,0 c -53.38,44.48 -90,67.8 -90,103.03 0,25.47 18.36,46.97 45,46.97 34.2,0 45,-37.5 45,-37.5 0,0 10.8,37.5 45,37.5 26.64,0 45,-21.5 45,-46.97 C 90,67.8 53.38,44.48 0,0 Z"
                                                    style="fill:none;stroke:#000000;stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path1635" />
                                            </g>
                                            <g id="g1637" transform="translate(376,400.75)">
                                                <path
                                                    d="m 0,0 c 0,0 7.2,26.25 30,26.25 17.76,0 30,-15.05 30,-32.88 0,-24.66 -24.42,-40.98 -60,-72.12 -35.58,31.14 -60,47.46 -60,72.12 0,17.83 12.24,32.88 30,32.88 C -7.2,26.25 0,0 0,0 Z"
                                                    style="fill:none;stroke:#000000;stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path1639" />
                                            </g>
                                            <g id="g1641" transform="translate(359,246)">
                                                <path
                                                    d="m 0,0 c -5.518,0 -10,4.482 -10,10 0,5.518 4.482,10 10,10 C 5.518,20 10,15.518 10,10 10,4.482 5.518,0 0,0"
                                                    style="fill:#000000;fill-opacity:1;fill-rule:nonzero;stroke:none"
                                                    id="path1643" />
                                            </g>
                                            <g id="g1645" transform="translate(313.9995,256)">
                                                <path d="M 0,0 H -58 L 2,-90 H 188 L 128,0 H 90"
                                                    style="fill:none;stroke:#000000;stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path1647" />
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </i>
                        <h3>Donation</h3>
                        <p>Soutenue par des leaders communautaires, des sponsors d'entreprise, des églises et des individus
                            comme
                            vous.</p>
                        <a href="donation-page.html">Faites un don maintenant</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div style="background-color:#26268e" class="volunteer fundraise mb-0">
                        <i>
                            <svg version="1.1" id="svg9" xml:space="preserve" width="682.66669"
                                height="682.66669" viewBox="0 0 682.66669 682.66669" xmlns="http://www.w3.org/2000/svg">
                                <defs id="defs13">
                                    <clipPath clipPathUnits="userSpaceOnUse" id="clipPath23">
                                        <path d="M 0,512 H 512 V 0 H 0 Z" id="path21" />
                                    </clipPath>
                                </defs>
                                <g id="g15" transform="matrix(1.3333333,0,0,-1.3333333,0,682.66667)">
                                    <g id="g17">
                                        <g id="g19" clip-path="url(#clipPath23)">
                                            <g id="g25" transform="translate(256,438.2524)">
                                                <path
                                                    d="m 0,0 c 0,0 20.772,20.774 41.545,41.54 22.945,22.943 60.146,22.943 83.091,0 22.944,-22.943 22.944,-60.145 0,-83.089 C 75.413,-90.769 0,-166.186 0,-166.186 c 0,0 -75.413,75.417 -124.635,124.637 -22.945,22.944 -22.945,60.146 0,83.089 22.945,22.943 60.146,22.943 83.091,0 C -20.772,20.774 0,0 0,0 Z"
                                                    style="fill:none;stroke:#fff;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path27" />
                                            </g>
                                            <g id="g29" transform="translate(15,336.3335)">
                                                <path d="M 0,0 32.133,16.066"
                                                    style="fill:none;stroke:#fff;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path31" />
                                            </g>
                                            <g id="g33" transform="translate(15,497)">
                                                <path d="M 0,0 32.133,-16.067"
                                                    style="fill:none;stroke:#fff;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path35" />
                                            </g>
                                            <g id="g37" transform="translate(497,336.3335)">
                                                <path d="M 0,0 -32.133,16.066"
                                                    style="fill:none;stroke:#fff;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path39" />
                                            </g>
                                            <g id="g41" transform="translate(497,497)">
                                                <path d="M 0,0 -32.133,-16.067"
                                                    style="fill:none;stroke:#fff;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path43" />
                                            </g>
                                            <g id="g45" transform="translate(299.9673,175.6665)">
                                                <path
                                                    d="m 0,0 h -105.004 c -12.783,0 -25.044,-5.077 -34.083,-14.114 -9.039,-9.038 -14.117,-21.297 -14.117,-34.086 h -51.43 v -80.333 H 17.21 c 14.547,0 28.499,5.784 38.786,16.067 33.744,33.747 108.903,108.907 108.903,108.907 -25.097,25.097 -65.789,25.097 -90.886,0 -19.172,-19.175 -39.701,-39.7 -51.296,-51.3 -6.023,-6.017 -14.192,-9.408 -22.711,-9.408 H -54.855 0 c 17.735,0 32.133,14.404 32.133,32.134 C 32.133,-14.396 17.735,0 0,0 Z"
                                                    style="fill:none;stroke:#fff;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                    id="path47" />
                                            </g>
                                            <path d="M 15,15 H 95.333 V 159.6 H 15 Z"
                                                style="fill:none;stroke:#fff;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                                id="path49" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </i>
                        <h3>Collecte de fonds</h3>
                        <p>Organisez une collecte de fonds pour soutenir les projets de la Fondation Rank. Chaque dollar
                            compte.</p>
                        <a href="fundraise-details.html">En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- debut apropos-->
    <section>
        <div class="container">
            <div class="heading">
                <img alt="icon" src="{{ asset('asset/img/logo-icon.png') }}">
                <p>Bienvenue à la Fondation Rank.</p>
                <h2>Nous aidons à construire un avenir meilleur grâce à l'éducation.</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-8">
                            <div class="help-man hoverimg">
                                <figure>
                                    <img alt="man" style="width: 40%;" class="w-100"
                                        src="{{ asset('asset/images/h1.jpeg') }}">
                                </figure>
                                <h5>Nous soutenons plus de 5k étudiants chaque année</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="help-man hoverimg">
                                <img alt="man" style="width: 15%;" class="helptwo w-100"
                                    src="{{ asset('asset/images/h2.jpeg') }}">
                                <figure>
                                    <img alt="man" style="width: 15%;" class="w-100 mt-4"
                                        src="{{ asset('asset/images/h3.jpeg') }}">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ps-xl-5">
                    <div class="help-man-data">
                        <p>
                            La Fondation Rank est dédiée à la construction d'un avenir meilleur grâce à l'éducation. Nous
                            croyons que
                            chaque enfant mérite une éducation de qualité.
                        </p>
                        <ul>
                            <li>
                                <div class="bol"></div>Créer des opportunités pour tous.
                            </li>
                            <li>
                                <div class="bol"></div>Soutenir les communautés rurales.
                            </li>
                            <li>
                                <div class="bol"></div>Changer le monde grâce à l'éducation.
                            </li>
                        </ul>
                        <a href="about.html" class="btn"><span>En savoir plus</span></a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- impacts-->
    <section class="gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="nonprofit">
                        <img alt="shaps" src="{{ asset('asset/img/shaps-1.png') }}">
                        <p>La Fondation Rank crée des opportunités pour</p>
                        <div class="justify-content-center d-flex align-items-center">
                            <div id="odometer" class="odometer odometer1" data-id="2000">0</div>
                            <span>+</span>
                        </div>
                        <h6>personnes chaque année</h6>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="nonprofit">
                        <img alt="shaps" src="{{ asset('asset/img/shaps-2.png') }}">
                        <p>Nos partenaires construisent l'apprentissage social et émotionnel</p>
                        <div class="justify-content-center d-flex align-items-center">
                            <div id="odometer2" class="odometer odometer2" data-id="100">0</div><span>M</span>
                        </div>
                        <h6>de jeunes gens servis</h6>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="nonprofit">
                        <img alt="shaps" src="{{ asset('asset/img/shaps-3.png') }}">
                        <p>Investir dans la Fondation Rank génère un retour sur investissement important, produisant</p>
                        <div class="justify-content-center d-flex align-items-center">
                            <span>$</span>
                            <div id="odometer3" class="odometer odometer3" data-id="1">0</div><span>M+</span>
                        </div>
                        <h6>d'impact depuis sa création</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- projets-->
    <section class="gap section-recent-causes">
        <div class="container">
            <div class="heading">
                <img alt="icon" src="{{ asset('asset/img/logo-icon.png') }}">
                <p>Travailler sur l'éducation et le développement rural</p>
                <h2>Projets récents</h2>
            </div>
            <div class="zoom-slider owl-carousel">
              @foreach (Projects() as $project)
                  <div class="item recent-causes">
                    <img alt="recentimg" src="{{ asset('storage/projects/thumbnails/resized_'. $project->image->name) }}">
                    <i class="fa-solid fa-bolt"></i>
                    <div class="recent-causes-data">
                        <a href="project-details.html">
                            <h3>{{ \Str::ucfirst(words($project->title, 8)) }}</h3>
                        </a>
                        <p>{!! \Str::ucfirst(words($project->description, 15)) !!}</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="{{ $project->collected }}"
                                aria-valuemin="0" aria-valuemax="{{ $project->goal }}"></div>
                        </div>
                        <div class="goal">
                            <span>Objectif: ${{ $project->goal }}</span>
                            <span>Collecté: ${{ $project->collected }}</span>
                        </div>
                        <a href="donation-page.html" class="btn two mt-3"><span>Faire un don maintenant</span></a>
                    </div>
                </div>
              @endforeach
                <!-- Vous pouvez ajouter d'autres projets de la même manière ici -->
            </div>
        </div>
    </section>


    <!-- usages de dons -->
    <section class="donation-section gap" style="background-image: url({{ asset('asset/images/p1.jpeg)') }}">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="homeless">
                        <h2>35,123 personnes aidées <span>jusqu'à présent !</span></h2>
                        <h6>La Fondation Rank travaille sans relâche pour soutenir l'éducation et le développement rural.
                        </h6>
                        <div class="d-flex">
                            <div>
                                <h5>Collecté<span>
                                        $8,100</span></h5>
                                <div class="separator"></div>
                                <h5>Objectif<span>
                                        $26,500</span></h5>
                            </div>
                            <div class="progressbar">
                                <div class="circle three" data-percent="75">
                                    <div>75%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="please-donate-today">
                        <h2>Faites un don aujourd'hui</h2>
                        <p>À quelle fréquence voulez-vous faire un don ?</p>
                        <form class="donate-form">
                            <ul class="d-flex">
                                <li>
                                    <input type="radio" id="Weekly" name="fav_language" value="Weekly">
                                    <label for="Weekly">Hebdomadaire</label>
                                </li>
                                <li>
                                    <input type="radio" id="Monthly" name="fav_language" value="Monthly">
                                    <label for="Monthly">Mensuel</label>
                                </li>
                                <li>
                                    <input type="radio" id="Yearly" name="fav_language" value="Yearly">
                                    <label for="Yearly">Annuel</label>
                                </li>
                            </ul>
                            <h6>Combien voulez-vous donner ?</h6>
                            <span class="give-currency-symbol">$</span>
                            <input class="donated_amount give-text-input" name="give-amount" type="text">
                            <ul class="give-donation-levels-wrap">
                                <li>
                                    <a class="donating give-donation-level-btn" href="JavaScript:void(0)">$<span
                                            class="donation_amount">10</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="donating give-donation-level-btn" href="JavaScript:void(0)">$<span
                                            class="donation_amount">20</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="donating give-donation-level-btn" href="JavaScript:void(0)">$<span
                                            class="donation_amount">50</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="donating give-donation-level-btn" href="JavaScript:void(0)">$<span
                                            class="donation_amount">100</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="donating give-donation-level-btn" href="JavaScript:void(0)">$<span
                                            class="donation_amount">200</span>
                                    </a>
                                </li>
                                <li><button type="button" class="give-donation-level-btn give-btn give-btn-level-custom"
                                        value="custom">Montant personnalisé</button></li>
                            </ul>
                            <input type="submit" class="give-submit" name="give-purchase"
                                value="Faire un don maintenant">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- evenements-->
    <section class="gap">
        <div class="container">
            <div class="heading">
                <img alt="icon" src="{{ asset('asset/img/logo-icon.png') }}">
                <p>Travailler sur l'éducation et le développement rural</p>
                <h2>Événements à venir</h2>
            </div>
            <div class="row">
                @foreach (events() as $event)
                    <div class="col-xl-4 col-lg-6">
                        <div class="upcoming-event-img">
                            <figure>
                                <img alt="upcoming-events" style="width: 360px;"
                                    src="{{ asset('storage/events/thumbnails/resized_' . $event->image->name) }}">
                            </figure>
                            <a href="event-details.html"><i class="fa-solid fa-angle-right"></i></a>
                            <div class="upcoming-event-time">
                                <h4>{{ $event->isoFormat('D') }}<span>{{ $event->isoFormat('MMM') }}<br>{{ $event->isoFormat('Y') }}</span>
                                </h4>
                                <div class="upcoming-event-separator"></div>
                                <h4>{{ $event->isoFormat('D') }}<span>{{ $event->isoFormat('MMM') }}<br>{{ $event->isoFormat('Y') }}</span>
                                </h4>
                            </div>
                            <div class="upcoming-event-data">
                                <a href="event-details.html">
                                    <h4>{{ \Str::ucfirst(words($event->title, 8)) }}</h4>
                                </a>
                                <h6 class="pb-2"><i class="fa-solid fa-clock pe-3"></i>{{ $event->tel }}</h6>
                                <h6><i class="fa-solid fa-location-dot pe-3"></i>{{ $event->lieu }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- rejoindre les bonnes causes-->
    <section class="join-cause">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-12">
                    <div class="change-we-need">
                        <div class="heading two">
                            <p>Rejoignez la bonne cause</p>
                            <h2>Changements que nous souhaitons réaliser</h2>
                        </div>
                        <ul class="heart">
                            <li><i class="fa-solid fa-heart pe-3"></i>Lancer un nouveau projet</li>
                            <li class="pt-3"><i class="fa-solid fa-heart pe-3"></i>Comment le changement se produit</li>
                            <li class="pt-3"><i class="fa-solid fa-heart pe-3"></i>Enseigner à vos enfants le don</li>
                            <li class="pt-3"><i class="fa-solid fa-heart pe-3"></i>Faire la différence</li>
                            <li class="pt-3"><i class="fa-solid fa-heart pe-3"></i>Participer à une course caritative
                            </li>
                            <li class="pt-3"><i class="fa-solid fa-heart pe-3"></i>S'impliquer dans nos événements</li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-12">
                    <div class="row change-we-img hoverimg">
                        <div class="col-8">
                            <figure>
                                <img alt="We Need" class="w-100" src="{{ asset('asset/images/cause1.jpeg') }}">
                            </figure>
                        </div>
                        <div class="col-4">
                            <figure>
                                <img alt="We Need" class="w-100" src="{{ asset('asset/images/cause2.jpeg') }}">
                            </figure>
                        </div>
                        <div class="col-4">
                            <figure>
                                <img class="mt-4 w-100" alt="We Need" src="{{ asset('asset/images/cause3.jpeg') }}">
                            </figure>
                        </div>
                        <div class="col-8">
                            <figure>
                                <img class="mt-4 w-100" alt="We Need" src="{{ asset('asset/images/cause4.jpeg') }}">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- partenaires-->
    <section class="partners-section gap">
        <div class="container">
            <div class="heading">
                <img alt="icon" src="{{ asset('asset/img/logo-icon.png') }}">
                <p>Travailler ensemble pour un avenir meilleur</p>
                <h2>Nos Partenaires</h2>
            </div>
            <div class="logodata owl-carousel owl-theme">
                <div class="partner item">
                    <img alt="partner-logo" src="https://via.placeholder.com/194x90')}}">
                </div>
                <div class="partner item">
                    <img alt="partner-logo" src="https://via.placeholder.com/194x90')}}">
                </div>
                <div class="partner item">
                    <img alt="partner-logo" src="https://via.placeholder.com/194x90')}}">
                </div>
                <div class="partner item">
                    <img alt="partner-logo" src="https://via.placeholder.com/194x90')}}">
                </div>
                <div class="partner item">
                    <img alt="partner-logo" src="https://via.placeholder.com/194x90')}}">
                </div>
            </div>
        </div>
    </section>

    <!-- non retouches-->
    <!-- newsletters-->
    <section class="environment-section" style="background-image: url({{ asset('asset/images/3.jpeg)') }}">
        <div class="container">
            <div class="environment">
                <div class="heading">
                    <h2>Recevez les <span>dernières nouvelles </span>de la Fondation Rank</h2>
                </div>
                <p>Vous pouvez vous désinscrire à tout moment et nous ne partagerons pas votre adresse e-mail avec des
                    tiers.
                </p>
                <form>
                    <input type="text" name="email" placeholder="Entrez votre adresse e-mail...">
                    <button class="btn"><span>S'inscrire</span></button>
                </form>
            </div>
        </div>
    </section>


    <!-- temoignages-->
    <section class="testimonials-section">
        <div class="container">
            <div class="slider-wrapper">
                <div class="slider-for testimonials" style="background-image: url({{ asset('asset/img/patrin.jpg)') }}">
                    <!-- Témoignage existant -->
                    <div class="slider-for__item ex1">
                        <img alt="comma" src="{{ asset('asset/img/comma.png') }}">
                        <h4>La Fondation Rank a changé ma vie en me donnant accès à une éducation de qualité.</h4>
                        <h3>Jean Muteba</h3>
                        <span>Kolwezi, RDC</span>
                    </div>

                    <!-- Témoignage 2 -->
                    <div class="slider-for__item ex1">
                        <img alt="comma" src="{{ asset('asset/img/comma.png') }}">
                        <h4>La Fondation Rank a ouvert des opportunités incroyables pour moi et ma communauté.</h4>
                        <h3>Maria Nkulu</h3>
                        <span>Lubumbashi, RDC</span>
                    </div>

                    <!-- Témoignage 3 -->
                    <div class="slider-for__item ex1">
                        <img alt="comma" src="{{ asset('asset/img/comma.png') }}">
                        <h4>Grâce à la Fondation Rank, j'ai pu poursuivre mes rêves d'éducation.</h4>
                        <h3>Joseph Kabila</h3>
                        <span>Lualaba, RDC</span>
                    </div>

                    <!-- Témoignage 4 -->
                    <div class="slider-for__item ex1">
                        <img alt="comma" src="{{ asset('asset/img/comma.png') }}">
                        <h4>La Fondation Rank a eu un impact positif sur ma vie et celle de ma famille.</h4>
                        <h3>Thérèse Tshisekedi</h3>
                        <span>Kinshasa, RDC</span>
                    </div>
                </div>
                <div class="slider-nav">
                    <!-- Image existante -->
                    <div class="slider-nav__item">
                        <img alt="img" src="{{ asset('asset/images/h2.jpeg') }}">
                    </div>

                    <!-- Image 2 -->
                    <div class="slider-nav__item">
                        <img alt="img" src="{{ asset('asset/images/h3.jpeg') }}">
                    </div>

                    <!-- Image 3 -->
                    <div class="slider-nav__item">
                        <img alt="img" src="{{ asset('asset/images/h2.jpeg') }}">
                    </div>

                    <!-- Image 4 -->
                    <div class="slider-nav__item">
                        <img alt="img" src="{{ asset('asset/images/h3.jpeg') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- actualités-->
    <section class="gap no-top">
        <div class="container">
            <div class="heading">
                <img alt="icon" src="{{ asset('asset/img/logo-icon.png') }}">
                <p>Travailler sur l'éducation et le développement rural</p>
                <h2>Articles récents</h2>
            </div>
            <div class="row">
              @foreach (LatestPosts() as $post)
                <!-- Article 1 -->
                <div class="offset-xl-1 col-xl-10">
                    <div class="article">
                        <img alt="article-img" style="max-width: 520px;" src="{{ asset('storage/posts/thumbnails/resized_'.$post->image->name) }}">
                        <div class="article-data">
                            <h4>
                              {{ $post->created_at->isoFormat('D')}}
                              <span>{{\Str::ucfirst($post->created_at->isoFormat('MMM'))}}, 
                                {{ $post->created_at->isoFormat('Y')}}</span></h4>
                            <div>
                                <h5>Par Fondation Rank</h5>
                                <a href="blog-details-1.html">
                                    <h3>{{ \Illuminate\Support\Str::limit($post->title,50) }}</h3>
                                </a>
                                <h6>{!! \Str::ucfirst(words($post->body, 15)) !!} </h6>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach

            </div>
        </div>
    </section>


@endsection
@push('custom_js')
@endpush
