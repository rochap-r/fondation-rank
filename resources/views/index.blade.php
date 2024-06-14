<!--Including main layouts-->
@extends('layouts.main')

@section('title', 'Mon Titre de la page')
@section('meta')
@endsection
@push('custom_css')
@endpush
@section('content')

<h1>Hello Ici le corps de la page</h1>

@endsection
@push('custom_js')
@endpush
