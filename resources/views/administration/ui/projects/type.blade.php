@extends('administration.ui.app')
@section('title', 'Types de Projets')

@section('content')


    @livewire('admin.ui.projects.type')

@endsection
@push('script')
    <script>
        window.addEventListener('hideTypeModal', function(e) {
            $('#type_modal').modal('hide');
        });

        window.addEventListener('showEditTypeModal', function(e) {
            $('#type_modal').modal('show');
        });

        //reunitialisation du form dans le modal
        $('#type_modal').on('hidden.bs.modal', function(e) {
            Livewire.dispatch('resetForm');
        });

        window.addEventListener('deleteType', function(event) {
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
                    Livewire.dispatch('deleteTypeAction', [event.detail[0].id]);
                }
            });
        });
    </script>
@endpush
