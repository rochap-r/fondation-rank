<!--Including main layouts-->
@extends('layouts.main')

@section('title', $project->title)
@section('meta')
@endsection
@push('custom_css')
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
                <li class="breadcrumb-item active" aria-current="page">{{ \Str::limit($project->title, 100) }}</li>
            </ol>
        </div>
    </section>

    <section class="gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-details-text hoverimg">
                        <figure>
                            <img alt="img" class="w-100"
                                src="{{ asset('storage/projects/' . $project->image->name) }}">
                        </figure>
                        <div class="blog-details-two-style">
                            <div class="article">
                                <h4>
                                    {{ $project->created_at->isoFormat('D') }}
                                    <span>{{ $project->created_at->isoFormat('MMM') }},
                                        {{ $project->created_at->isoFormat('Y') }}</span>
                                </h4>
                            </div>
                            <h2>{{ $project->title }}</h2>

                            <h4 class="text-primary text-uppercase">{{ $project->typeProject->name }}</h4>

                            {!! $project->description !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
