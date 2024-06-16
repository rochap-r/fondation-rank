@extends('administration.ui.app')

@section('title', 'Projet | Création d\'un nouveau projet')

@push('style')
    <style>
        .imageuploadfy {
            border: 0;
            max-width: 100%;
        }

        header {
            background: linear-gradient(rgba(47, 53, 75, 0.6), rgba(35, 90, 72, 0.6)), url({{ asset('') }});
            background-size: cover;
            background-position: center;
            color: #fff;
        }

        header .display-4 {
            font-size: 2.5rem;
            line-height: 1.2;
        }

        header .btn-primary {
            border-color: #fff;
            background-color: transparent;
            color: #fff;
        }

        header .btn-primary:hover {
            background-color: #fff;
            color: #000;
        }
    </style>
    <script src="https://cdn.tiny.cloud/1/4ejo52d7vmm4gxrci2t88pn5fi728scmvommghtkv63jupfh/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
@endpush
@section('content')
    <header class="bg-dark text-white text-center py-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-6">Création d'un nouveau projet</h1>
                    <a href="{{ route('admin.project.index') }}" class="btn btn-primary btn-lg">Accueil</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <form method="POST" action="{{ route('admin.project.add') }}" id="addProject" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titre:</label>
                <input type="text" class="form-control" id="title" name="title">
                <span class="text-danger error-text title_error"></span>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <span class="text-danger error-text image_error"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="image_holder mb-2" style="max-width: 250px;">
                        <img src="" alt="" class="img-thumbnail" id="image-previewer"
                            data-ijabo-default-img="">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="goal" class="form-label">Objectif:</label>
                <input type="number" class="form-control " id="goal" name="goal">
                <span class="text-danger error-text goal_error"></span>
            </div>
            <div class="mb-3">
                <label for="collected" class="form-label">Collecté:</label>
                <input type="number" class="form-control " id="collected" name="collected">
                <span class="text-danger error-text collected_error"></span>
            </div>
            <div class="mb-3">
                <label for="type_project" class="form-label">Type:</label>
                <select class="form-select mb-3" id="type_project" name="type_project_id">
                    <option value="">-- Aucune sélection --</option>
                    @foreach (\App\Models\TypeProject::all() as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger error-text type_project_error"></span>
            </div>

            <div class="mb-3">
                <label for="project-desc" class="form-label">Description:</label>
                <textarea class="form-control" id="project-desc" name="description"></textarea>
                <span class="text-danger error-text description_error"></span>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>


@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log(csrfToken);
            tinymce.init({
                selector: '#project-desc',
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                },
                plugins: 'advlist autolink lists link image media charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
                height: '800',
                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | rtl ltr',
                toolbar_mode: 'floating',
                image_title: true,
                automatic_uploads: true,
                images_upload_url: '{{ route('admin.upload_tinymce_image') }}',
                file_picker_types: 'image',
                file_picker_callback: function(cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function() {
                            var id = 'blobid' + (new Date()).getTime();
                            blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);

                            // Ajoutez le jeton CSRF aux données envoyées à la route
                            var data = new FormData();
                            data.append('_token', csrfToken);
                            data.append('file', file);
                            
                            console.log(csrfToken);

                            // Effectuez une requête AJAX vers la route d'upload
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '{{ route('admin.upload_tinymce_image') }}');
                            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    var response = JSON.parse(xhr.responseText);
                                    cb(response.location, {
                                        title: response.title
                                    });
                                }
                            };
                            xhr.send(data);
                        };
                    };
                    input.click();
                }
            });
        });


        $(function() {
            $('input[type="file"][name="image"]').ijaboViewer({
                preview: '#image-previewer',
                imageShape: 'rectangular',
                allowedExtensions: ['jpg', 'jpeg', 'png', 'webp'],
                onErrorShape: function(message, element) {

                },
                onInvalidType: function(message, element) {

                }
            });
        });

        $('form#addProject').on('submit', function(e) {
            e.preventDefault();
            toastr.remove();

            // Obtenez le contenu de l'éditeur TinyMCE
            var body = tinymce.get('project-desc').getContent();
            var form = this;
            var frmdata = new FormData(form);
            frmdata.append('description', body);

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: frmdata,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(response) {
                    toastr.remove();
                    if (response.code === 1) {
                        $(form)[0].reset();
                        $('div.image_holder').html('');

                        // Réinitialisez le contenu de l'éditeur TinyMCE
                        tinymce.get('project-desc').setContent('');

                        toastr.success(response.msg);
                        //redirect
                        setTimeout(function() {
                            location.href = response.redirectUrl;
                        }, 1500);
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function(response) {
                    toastr.remove();
                    $.each(response.responseJSON.errors, function(prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                }
            });
        });
    </script>
@endpush
