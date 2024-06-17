<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Fondation RANK">
    <meta name="author" content="Fondation Ruwej A Nkond, Oeuvrant dans la promotion de l'éducation et le dévéloppement rural">
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
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" value=""
                                :value="old('email')" placeholder="Entrez votre email" autofocus
                                autocomplete="username" required>
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password"
                                placeholder="Entrez votre Mot de passe" autocomplete="current-password" required>
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <button
                            class="btn btn-primary w-100 text-uppercase text-white rounded-2 lh-34 ff-heading fw-bold shadow">
                            Connexion
                        </button>

                        <p class="d-flex align-items-center justify-content-between mt-4 mb-4">Mot de passe oublié? <a
                                href="{{ route('password.request') }}"
                                class="text-primary fw-bold text-decoration-underline">Cliquez ici</a></p>

                    </form>
                </div>
            </div>
        </div>
    </div>



</body>

</html>
