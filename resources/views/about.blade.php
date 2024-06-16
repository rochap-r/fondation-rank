<!--Including main layouts-->
@extends('layouts.main')

@section('title', $about->title)
@section('meta')
@endsection
@push('custom_css')
@endpush
@section('content')

    <section class="page-title-area" style="background-image:url(https://via.placeholder.com/1920x430)">
        <div class="container">
            <div class="title-area-data">
                <h2>Apropos</h2>
                <p class="mt-2">{{ $about->title }}</p>
            </div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('about',$about->slug) }}">Apropos</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $about->title }}</li>
            </ol>
        </div>
    </section>

    <section class="gap">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    <div class="sidebar">
                        <div class="posts">
                            <ul class="categories">
                                @foreach (abouts() as $listAbout)
                                    <li>
                                        <a href="{{ route('about', $listAbout->slug) }}">{{ $listAbout->title }}
                                            @if ($listAbout->id==$about->id)
                                                <span class="alert alert-success">
                                                    <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </span>
                                            @endif                                        
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="blog-details-text hoverimg">
                        <figure>
                            <img alt="img" class="w-100" src="{{ asset('storage/abouts/'.$about->image->name) }}">
                        </figure>

                        <h2 class="mt-2">{{ $about->title }}</h2>

                        <hr class="bg-primary mb-2">
                        {!! $about->content !!}
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
@push('custom_js')
@endpush
