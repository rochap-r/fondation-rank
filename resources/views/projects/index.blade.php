<!--Including main layouts-->
@extends('layouts.main')

@section('title', 'Projets')
@section('meta')
@endsection
@push('custom_css')
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            list-style-type: none;
            padding: 0;
        }

        .text-muted {
            font-size: 20px !important;
        }

        .page-item {
            margin: 0 5px;
            /* Spacing between items */
        }

        .page-link {
            display: block;
            padding: 0 16px;
            height: 40px;
            line-height: 40px;
            min-width: 40px;
            box-sizing: border-box;
            text-align: center;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            /* Adjust this value to increase text size */
        }



        .page-item.active .page-link,
        .page-item.disabled .page-link {
            background-color: #252d35;
        }

        .page-item.active .page-link {
            pointer-events: none;
        }
    </style>
@endpush
@section('content')

    <section class="page-title-area" style="background-image:url(https://via.placeholder.com/1920x430)">
        <div class="container">
            <div class="title-area-data">
                <h2>Projets</h2>
                <p class="mt-2">Les Projets de la fondation RANK</p>
            </div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Accueil</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('project.index') }}">Projets</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tous les Projets</li>
            </ol>
        </div>
    </section>


    <section class="gap shop-products our-shop mt-0">
        <div class="container">
            <h1>Nos Projets</h1>
            <div class="row">
                @forelse($projects as $project)
                    <div class="col-lg-4 col-sm-6">
                        <div class="card mt-3">
                            <!-- Image du projet -->
                            <div class="position-relative">
                                <img src="{{ $project->image
                                    ? (\Illuminate\Support\Str::startsWith($project->image->path, 'placeholders/')
                                        ? asset('placeholders/project.png')
                                        : asset('storage/projects/thumbnails/resized_' . $project->image->name))
                                    : 'https://via.placeholder.com/300x200' }}"
                                    class="card-img-top" alt="Image du Projet">

                                <!-- Indication "Nouveau" -->
                                @if ($project->created_at->diffInHours(now()) <= 12)
                                    <span
                                        class="badge bg-success position-absolute top-0 start-0 translate-middle m-2">New</span>
                                @endif
                            </div>

                            <!-- Corps de la carte -->
                            <div class="card-body">
                                <!-- Type de projet -->
                                <span class="badge bg-info text-dark mb-2">{{ $project->typeProject->name }}</span>

                                <!-- Titre du projet -->
                                <h5 class="card-title">{{ Str::limit($project->title, 50) }}</h5>

                                <!-- Objectif et Montant collecté -->
                                <div class="d-flex justify-content-between">
                                    <p class="card-text mb-0">Objectif:
                                        ${{ number_format($project->goal, 0, ',', ' ') }}</p>
                                    <p class="card-text mb-0 text-success">Collecté:
                                        ${{ number_format($project->collected, 0, ',', ' ') }}</p>
                                </div>

                                <!-- Date de création du projet -->
                                <p class="card-text mt-2">Créé {{ $project->created_at->diffForHumans() }}</p>

                                <!-- Bouton pour voir plus de détails -->
                                <a href="{{ route('project.show',$project->slug) }}" class="btn btn-primary mt-3">Découvrir le projet</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-4 col-md-6">
                        <p class="text-danger lead"> Aucun Projet disponible!</p>
                    </div>
                @endempty
                <div class="row mt-4">
                    {{ $projects->links() }}
                </div>

        </div>
    </div>
</section>

@endsection
@push('custom_js')
@endpush
