<!--Including main layouts-->
@extends('layouts.main')

@section('title', $post->title)
@section('meta')
@endsection
@push('custom_css')
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

                <li class="breadcrumb-item">
                    <a href="{{ route('blog.index') }}">Actualités</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ \Str::limit($post->title, 100) }}</li>
            </ol>
        </div>
    </section>


    <div class="row">
        <div class="col-lg-8">
            <article class="m-4">
                <!-- Image en entête -->
                <figure class="mb-4">
                    <img src="{{ asset('storage/posts/' . $post->image->name) }}" class="img-fluid w-100 rounded"
                        alt="Image de l'article: {{ $post->title }}">
                </figure>
                <!-- Contenu de l'article -->
                <header class="mb-3">
                    <h1>{{ $post->title }}</h1>
                    <p class="text-muted">Par {{ $post->author->name }} le {{ $post->created_at->format('d/m/Y') }}</p>
                </header>
                <section class="article-content">
                    {!! $post->body !!}
                </section>
            </article>
        </div>
        <!-- Sidebar avec catégories et articles récents -->
        <div class="col-lg-4">
            <!-- Catégories -->
            <aside class="mx-3 mt-4">
                <h3 class="mb-3 text-center p-2 bg-primary text-white rounded-top">Catégories</h3>
                <ul class="list-group shadow">
                    @foreach (categories() as $category)
                        <li class="list-group-item my-1 bg-light">
                            <!-- Ajout d'icônes et de couleurs pour différencier les catégories -->
                            <a href="{{ route('category.index', $category) }}"
                                class="text-decoration-none d-flex align-items-center">
                                <i class="bi bi-tag-fill text-primary me-2"></i> <!-- Icône de catégorie -->
                                <span class="text-dark fw-bold">{{ $category->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            <!-- Articles récents -->
            <aside class="mx-3 mt-4">
                <h3 class="mb-3">Articles récents</h3>
                @foreach (LatestPosts() as $recent_post)
                    <div class="card mb-3 shadow">
                        <!-- Utilisation d'une balise d'ancre pour rendre toute la carte cliquable -->
                        <a href="{{ route('blog.show', $recent_post->slug) }}" class="text-decoration-none text-dark">
                            <div class="card mb-3 shadow">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/posts/thumbnails/thumb_' . $recent_post->image->name) }}"
                                            class="img-fluid rounded-start h-100" alt="{{ $recent_post->title }}">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body bg-light">
                                            <h6 class="card-title text-truncate">
                                                {{ $recent_post->title }}
                                            </h6>
                                            <p class="card-text">
                                                <small
                                                    class="text-muted">{{ $recent_post->created_at->diffForHumans() }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                @endforeach
            </aside>
        </div>

    </div>





@endsection
@push('custom_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('img').forEach(function(img) {
                img.removeAttribute('width');
                img.style.width = '100%';
                img.removeAttribute('height'); // Remove the height attribute if needed
            });
        });
    </script>
@endpush
