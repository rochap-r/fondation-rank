<div>
    {{-- In work, do what you enjoy. --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center text-uppercase">
            <h4 class="card-title">Liste d'Articles</h4>
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.post.create') }}" class="btn btn-primary">Ajouter un Article</a>
            </div>
        </div>

        <hr class="bg-dark">

        <div class="card-header d-flex justify-content-between align-items-center text-uppercase">
            <div class="col-md-3 mb-1">
                <label for="input" class="form-label">Recherche d'article par titre </label>
                <input type="text" id="input" class="form-control" placeholder="tapez un titre ici..."
                    wire:model.live="search">
            </div>
            <div class="col-md-3 mb-1">
                <label for="select" class="form-label">Recherche par catégorie</label>
                <select id="select" class="form-select" wire:model.live="category">
                    <option value="">-- selectionnez une catégorie --</option>
                    @foreach (\App\Models\Category::whereHas('posts')->select('id', 'name')->get() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-1">
                <label for="select" class="form-label">Recherche par Auteur</label>
                <select id="select" class="form-select" wire:model.live="author">
                    <option value="">-- selectionnez l'auteur --</option>
                    @foreach (\App\Models\User::whereHas('posts')->select('id', 'name')->get() as $auteur)
                        <option value="{{ $auteur->id }}">{{ $auteur->name }} {{ $auteur->fname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-1">
                <label for="select" class="form-label">Ordonner de façon</label>
                <select id="select" class="form-select" wire:model.live="orderBy">
                    <option value="desc"> DESCENDANTE </option>
                    <option value="asc">ASCENDANTE</option>
                </select>
            </div>
        </div>
        <div class="card-body">
            <div class="row row-cards">
                @forelse($posts as $post)
                    <div class="col-md-4 col-lg-3" wire:key="{{ $post->id }}">
                        <div class="card h-100">
                            <img src="{{ $post->image
                                ? (\Illuminate\Support\Str::startsWith($post->image->path, 'placeholders/')
                                    ? asset('placeholders/post.png')
                                    : asset('storage/posts/thumbnails/resized_' . $post->image->name))
                                : asset('placeholders/post.png') }}"
                                alt="" class="card-img-top">
                            <div class="card-body p-2">
                                <h3 class="m-0 mb-1">{{ Str::limit($post->title, 60) }}</h3>
                            </div>
                            <div class="card-body p-2 text-center">
                                <h3 class="m-0 mb-1">
                                    @if ($post->approved)
                                        <span class="badge badge-success">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-check" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l5 5l10 -10"></path>
                                            </svg>
                                        </span>
                                    @else
                                        <span class="badge badge-danger text-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-alert-octagon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M9.103 2h5.794a3 3 0 0 1 2.122 .879l4.101 4.1a3 3 0 0 1 .88 2.125v5.794a3 3 0 0 1 -.879 2.122l-4.1 4.101a3 3 0 0 1 -2.123 .88h-5.795a3 3 0 0 1 -2.122 -.88l-4.101 -4.1a3 3 0 0 1 -.88 -2.124v-5.794a3 3 0 0 1 .879 -2.122l4.1 -4.101a3 3 0 0 1 2.125 -.88z">
                                                </path>
                                                <path d="M12 8v4"></path>
                                                <path d="M12 16h.01"></path>
                                            </svg>
                                        </span>
                                    @endif

                                    <span
                                        class="card-badge badge badge-default">{{ $post->created_at->isoFormat('D') }}-{{ \Str::ucfirst($post->created_at->isoFormat('MMM')) }}-{{ $post->created_at->isoFormat('Y') }}</span>
                                </h3>
                            </div>
                            <div class="d-flex">
                                @php
                                    $class = $post->approved ? 'info' : 'warning';
                                @endphp
                                <a href="" class="card-btn btn  btn-primary"
                                    wire:click.prevent='readPost({{ $post->id }})'><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg></a>

                                <a href="{{ route('admin.post.edit', $post->slug) }}" class="card-btn btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-minus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                        <path d="M13.5 6.5l4 4" />
                                        <path d="M16 19h6" />
                                    </svg>
                                </a>
                                <a href="" wire:click.prevent="deletePost({{ $post->id }})"
                                    class="card-btn btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <span class="text-danger">
                        Aucun article n'est disponible!
                    </span>
                @endforelse
                <div class="d-block mt-4">
                    {{ $posts->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </div>







    <!-- Modale de la Description du Projet -->
    <div wire:ignore.self class="modal modal-blur fade" id="read_modal" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $postRead->title ?? '' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="container mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ $postRead
                                ? (\Illuminate\Support\Str::startsWith($postRead->image->path, 'placeholders/')
                                    ? asset('placeholders/post.png')
                                    : asset('storage/posts/' . $postRead->image->name))
                                : 'https://via.placeholder.com/300x200' }}"
                                class="img-fluid rounded" alt="{{ $postRead->title ?? '' }}" style="width: 1140px;">
                        </div>
                        <hr>
                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Détails d'Article</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Redacteur(trice) :</strong>
                                            {{ $postRead ? $postRead->author->name : '' }}
                                        </li>
                                        <li class="list-group-item"><strong>Date de Redaction :</strong>
                                            {{ $postRead ? $postRead->created_at->diffForHumans() : '' }}</li>
                                        <li class="list-group-item"><strong>Catégorie d'Article :</strong>
                                            {{ $postRead ? $postRead->category->name : '' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr class="bg-dark">
                        <div class="col-md-12 mt-4">
                            <p>{!! $postRead ? $postRead->body : '' !!}</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
