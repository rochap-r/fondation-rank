<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Fondation RANK">
    <meta name="author"
        content="Fondation Ruwej A Nkond, Oeuvrant dans la promotion de l'éducation et le dévéloppement rural">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Authentification')</title>

    <!-- Styles Include -->
    <link rel="stylesheet" href="{{ asset('login/css/main.css') }}" id="stylesheet">

</head>

<body class="bg-primary">

    <!-- Login Form -->
    <div class="row align-items-center justify-content-center vh-100">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6">
            <div class="card rounded-2 border-0 p-5 m-0">

                <div class="card-header border-0 p-0 text-center">
                    <a href="{{ route('home') }}" class="w-100 d-inline-block mb-5">
                        <img src="{{ asset('asset/img/logo.png') }}" alt="img" style="max-width:105px!important;">
                    </a>
                    <h3>Fondation RANK</h3>
                    <p class="fs-14 text-dark my-4">Veuillez vous authentifier.</p>
                </div>

                <div class="card-body p-0">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @csrf
                        <div class="form-group">
                            <label for="email">Adresse e-mail</label>
                            <input id="email" type="email" class="form-control" name="email" value=""
                                 autofocus placeholder="Entrez l'e-mail">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe
                                <a href="" class="float-right">
                                    Mot de passe oublié?
                                </a>
                            </label>
                            <input id="password" type="password" class="form-control" name="password"  data-eye
                                placeholder="Entrer le mot de passe" autocomplete="off">
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                <label for="remember" class="custom-control-label">Se souvenir de moi</label>
                            </div>
                        </div>

                        <button
                            class="btn btn-primary w-100 text-uppercase text-white rounded-2 lh-34 ff-heading fw-bold shadow">
                            Connexion
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>



</body>

</html>
