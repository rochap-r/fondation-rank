@extends('administration.ui.app')
@section('title', 'Articles | Accueil')
@push('style')
    {{-- CSS complementaires --}}
@endpush

@section('content')



    @livewire('admin.ui.posts.post')


@endsection
@push('script')
    <script>
        
        window.addEventListener('showReadPost', function(e) {
            $('#read_modal').modal('show');
        });

        //reunitialisation du form dans le modal
        $('#read_modal').on('hidden.bs.modal', function(e) {
            
            Livewire.dispatch('resetForm');
        });


        window.addEventListener('deletePost', function(event) {
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
                    Livewire.dispatch('deletePostAction', [event.detail[0].id]);
                }
            });
        });
    </script>
@endpush
