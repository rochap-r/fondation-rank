<!--Including main layouts-->
@extends('layouts.main')

@section('title', 'Actualités')
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
                <h2>Actualités</h2>
                <p class="mt-2">Restez informer grace à nos actualités</p>
            </div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Accueil</a>
                </li>

                <li class="breadcrumb-item active">
                    <a href="{{ route('blog.index') }}">Actualités</a>
                </li>
            </ol>
        </div>
    </section>

    <section class="gap shop-products our-shop mt-0">
        <div class="container">
            <h1>Actualités</h1>
            <div class="row">
                @forelse($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <article class="card mb-4 shadow-sm">
                            <figure class="card-img-top rounded">
                                <img src="{{ asset('storage/posts/thumbnails/thumb_' . $post->image->name) }}"
                                    alt="Image de l'article: {{ $post->title }}">
                            </figure>
                            <div class="card-body d-flex flex-column">
                                <header>
                                    <h4 class="card-title"><a href="{{ route('blog.show', $post->slug) }}"
                                            class="stretched-link text-white">{{ words($post->title, 8) }}</a>
                                    </h4>
                                    <p class="text-muted mb-2 fs-6">
                                        <i class="flaticon-user me-1"></i>Par <a href="#"
                                            aria-label="Auteur: {{ $post->author->name }}">{{ $post->author->name }}</a>
                                    </p>
                                    <p class="mb-2">
                                        <a href="{{ route('category.index', $post->category) }}"
                                            class="badge bg-primary text-decoration-none fs-6"
                                            aria-label="Catégorie: {{ $post->category->name }}">{{ $post->category->name }}</a>
                                    </p>



                                </header>
                                <footer class="mt-auto">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary"
                                        aria-label="Lire l'article: {{ $post->title }}">Lire plus...</a>
                                </footer>
                            </div>
                        </article>
                    </div>


                @empty
                    <div class="col-lg-4 col-md-6">
                        <p class="text-danger lead"> Aucun Projet disponible!</p>
                    </div>
                @endempty
                <div class="row mt-4">
                    {{ $posts->links() }}
                </div>

        </div>
    </div>
</section>

@endsection
@push('custom_js')
@endpush
