@extends('administration.ui.app')
@section('title', 'Mon Profile')
@push('style')
    {{-- CSS complementaires --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.4.2/tinymce.min.js"
        integrity="sha512-sWydClczl0KPyMWlARx1JaxJo2upoMYb9oh5IHwudGfICJ/8qaCyqhNTP5aa9Xx0aCRBwh71eZchgz0a4unoyQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('content')
    @livewire('admin.ui.users.profile')
    <hr>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                    <li class="nav-item">
                        <a href="#tabs-infos" class="nav-link active" data-bs-toggle="tab">Informations Personnelles</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-security" class="nav-link" data-bs-toggle="tab">Sécurité</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tabs-infos">
                        <h4>Infos Personnelles</h4>
                        <div>
                            @livewire('admin.ui.users.profile-infos')
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-security">
                        <h4>Sécurité</h4>
                        <div>
                            @livewire('admin.ui.users.profile-password')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let options = {
                    selector: '#form-description',
                    height: 300,
                    menubar: 'favs file edit  format',
                    statusbar: false,
                    plugins: [
                        'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor',
                    ],
                    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
                        'bullist numlist outdent indent | link' +
                        'forecolor backcolor',
                    content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }',
                    setup: function(editor) {
                        // Ajoutez un gestionnaire d'événements pour l'événement 'change'
                        editor.on('change', function(e) {
                            // Mettez à jour les données de Livewire manuellement
                            Livewire.find(document.getElementById('form-description').closest(
                                '[wire\\:id]').getAttribute('wire:id')).set('description', editor
                                .getContent());
                        });
                    }
                }
                if (localStorage.getItem("tablerTheme") === 'dark') {
                    options.skin = 'oxide-dark';
                    options.content_css = 'dark';
                }
                tinyMCE.init(options);
            })

            $('#changeProfile').ijaboCropTool({
                preview: '',
                setRatio: 1,
                allowedExtensions: ['jpg', 'jpeg', 'png'],
                buttonsText: ['CROP', 'QUIT'],
                buttonsColor: ['#30bf7d', '#ee5155', -15],
                processUrl: '{{ route('admin.users.changePicture') }}',
                withCSRF: ['_token', '{{ csrf_token() }}'],
                onSuccess: function(message, element, status) {
                    //alert(message);
                    //listeners en ecoute pour l'actualisation de deux endroits ou se trouve les deux pictures
                    Livewire.dispatch('UpdateHeader');
                    Livewire.dispatch('UpdateProfile');
                    toastr.success(message)
                },
                onError: function(message, element, status) {
                    //alert(message);
                    toastr.error(message)
                }
            });

            /*
            How to detected a wire event
            document.addEventListener('DOMContentLoaded', function() {
                Livewire.on('alertSuccess', (event) => {
                    alert(event[0].message);
                });
            });*/
        </script>
    @endpush
