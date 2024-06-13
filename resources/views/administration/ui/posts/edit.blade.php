@extends('administration.ui.app')

@section('title', 'Article | Edition de l\'article: ' . $post->title)

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
@endpush
@section('content')
    <header class="bg-dark text-white text-center py-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-6">Edition du Projet : {{ $post->title }} </h1>
                    <a href="{{ route('admin.post.index') }}" class="btn btn-primary btn-lg">Accueil</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <form method="POST" action="{{ route('admin.post.update', $post) }}" id="editPost" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titre:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
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
                            data-ijabo-default-img="{{ $post->image
                                ? (\Illuminate\Support\Str::startsWith($post->image->path, 'placeholders/')
                                    ? asset('placeholders/post.png')
                                    : asset('storage/posts/thumbnails/resized_' . $post->image->name))
                                : asset('placeholders/post.png') }}">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categorie d'Article:</label>
                <select class="form-select mb-3" id="category" name="category_id">
                    <option value="">-- Aucune sélection --</option>
                    @foreach (\App\Models\Category::all() as $category)
                        <option {{ $post->category->id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger error-text category_id_error"></span>
            </div>

            <div class="mb-3">
                <label for="post-desc" class="form-label">Contenu:</label>
                <textarea class="form-control" id="post-desc" name="body">
                    {!! $post->body !!}
                </textarea>
                <span class="text-danger error-text body_error"></span>
            </div>

            <div class="mb-3">
                <div class="bg-white ">
                    <label class="row">
                        <span
                            class="col {{ $post->approved ? 'text-success' : 'text-danger' }}">{{ $post->approved ? 'Approuvé' : 'Non Approuvé' }}</span>
                        <span class="col-auto">
                            <label class="form-check form-check-single form-switch">
                                <input class="form-check-input" {{ $post->approved ? 'checked' : '' }} type="checkbox"
                                    name="approved">
                                <span class="text-danger error-text approved_error"></span>
                            </label>
                        </span>
                    </label>
                </div>
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
                selector: '#post-desc',
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
                images_upload_url: '{{ route('admin.upload_tinymce_posts_image') }}',
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

                            // Effectuez une requête AJAX vers la route d'upload
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST',
                                '{{ route('admin.upload_tinymce_posts_image') }}');
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


        $('form#editPost').on('submit', function(e) {
            e.preventDefault();
            toastr.remove();

            // Obtenez le contenu de l'éditeur TinyMCE
            var body = tinymce.get('post-desc').getContent();
            var form = this;
            var frmdata = new FormData(form);
            frmdata.append('body', body);

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: frmdata,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                    tinymce.get('post-desc').setContent('');
                },
                success: function(response) {
                    toastr.remove();
                    if (response.code === 1) {
                        $(form)[0].reset();
                        $('div.image_holder').html('');
                        tinymce.get('post-desc').setContent(response.body);

                        // Mettez à jour l'état de la case à cocher et le label
                        var checkbox = $('input[name="approved"]');
                        var statusLabel = $('.col');
                        checkbox.prop('checked', response.approved);
                        statusLabel.text(response.approved ? 'Approuvé' : 'Non Approuvé');
                        statusLabel.attr('class', 'col ' + (response.approved ? 'text-success' :
                            'text-danger'));

                        toastr.success(response.msg);

                        setTimeout(function() {
                            location.href = response.redirectUrl;
                        }, 2000);

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
