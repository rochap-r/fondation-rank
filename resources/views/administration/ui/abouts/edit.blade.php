@extends('administration.ui.app')
@section('title', 'Edition d\'Apropos: ' . $about->title)
@push('style')
    {{-- CSS complementaires --}}
@endpush

@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title text-uppercase">
                        Edition: {{ $about->title }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <a href="{{ route('admin.event.index') }}" class="btn btn-primary text-uppercase">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-check"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3.5 5.5l1.5 1.5l2.5 -2.5"></path>
                                <path d="M3.5 11.5l1.5 1.5l2.5 -2.5"></path>
                                <path d="M3.5 17.5l1.5 1.5l2.5 -2.5"></path>
                                <path d="M11 6l9 0"></path>
                                <path d="M11 12l9 0"></path>
                                <path d="M11 18l9 0"></path>
                            </svg>
                            Voir les événements
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.about.update', $about) }}" id="editAbout" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-title">Titre de la Rubrique</label>
                    <input type="text" class="form-control" id="form-title" name="title"
                        placeholder="Saisissez le titre de la rubrique" value="{{ $about->title }}">
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
                                data-ijabo-default-img="{{ $about->image
                                    ? (\Illuminate\Support\Str::startsWith($about->image->path, 'placeholders/')
                                        ? asset('placeholders/post.png')
                                        : asset('storage/abouts/thumbnails/resized_' . $about->image->name))
                                    : asset('placeholders/post.png') }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="content">Contenu de la Rubrique </label>
                    <textarea class="form-control" id="about-desc" name="content" rows="40">
                                {!! $about->content !!}
                            </textarea>
                    <span class="text-danger error-text content_error"></span>
                </div>
                

                <div class="mb-3">
                    <div>
                        <label class="row">
                            <span
                                class="col {{ $about->approved ? 'text-success' : 'text-danger' }}">{{ $about->approved ? 'Rubrique Approuvée' : 'Rub non Approuvée' }}</span>
                            <span class="col-auto">
                                <label class="form-check form-check-single form-switch">
                                    <input class="form-check-input" {{ $about->approved ? 'checked' : '' }} type="checkbox"
                                        name="approved">
                                    <span class="text-danger error-text approved_error"></span>
                                </label>
                            </span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"> Enregistrer la rubrique</button>

            </div>
        </div>
    </form>

@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log(csrfToken);
            tinymce.init({
                selector: '#about-desc',
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
                images_upload_url: '{{ route('admin.upload_tinymce_abouts_image') }}',
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
            })
        });

        $('form#editAbout').on('submit', function(e) {
            e.preventDefault();
            toastr.remove();
            // Obtenez le contenu de l'éditeur TinyMCE
            var body = tinymce.get('about-desc').getContent();
            var form = this;
            var frmdata = new FormData(form);
            frmdata.append('content', body);

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: frmdata,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                    tinymce.get('about-desc').setContent('');
                },
                success: function(response) {
                    toastr.remove();
                    if (response.code === 1) {
                        $(form)[0].reset();
                        $('div.image_holder').html('');
                        tinymce.get('about-desc').setContent(response.content);

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
