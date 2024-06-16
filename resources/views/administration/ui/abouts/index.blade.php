@extends('administration.ui.app')
@section('title', 'Gestions d\'Apropos')
@push('style')
    {{-- CSS complementaires --}}
@endpush

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Liste des Rubriques d'Apropos
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="{{ route('admin.about.create') }}" class="btn btn-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Nouvelle Rubrique
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('admin.ui.abouts.about')

@endsection
@push('script')
    <script>
        window.addEventListener('showReadAbout', function(e) {
            $('#read_modal').modal('show');
        });

        //reunitialisation du form dans le modal
        $('#read_modal').on('hidden.bs.modal', function(e) {
            
            Livewire.dispatch('resetForm');
        });

        window.addEventListener('deleteAbout', function(event) {
            Swal.fire({
                title: event.detail[0].title,
                imageUrl: event.detail[0].imageUrl,
                imageWidth: 56,
                imageHeight: 56,
                html: event.detail[0].html,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Oui, Supprimer',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                width: 500,
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    Livewire.dispatch('deleteEventAction', [event.detail[0].id]);
                }
            });
        });
    </script>
@endpush
