<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="col-md-7 m-1">
                <label for="input" class="form-label">Recherche d'article par titre</label>
                <input type="text" id="input" class="form-control" placeholder="Tapez un titre ici..."
                    wire:model.live="search">
            </div>
            <div class="col-md-5 m-1">
                <label for="select" class="form-label">Ordonner de façon</label>
                <select id="select" class="form-select" wire:model.live="orderBy">
                    <option value="desc">DESCENDANTE</option>
                    <option value="asc">ASCENDANTE</option>
                </select>
            </div>

        </div>
        <div class="card-body">
            <div class="row row-cards">
                @forelse($abouts as $about)
                    <div class="col-md-6 col-lg-3" wire:key='{{$about->id}}'>
                        <div class="card">
                            <img src="{{ $about->image
                                ? (\Illuminate\Support\Str::startsWith($about->image->path, 'placeholders/')
                                    ? asset('placeholders/post.png')
                                    : asset('storage/abouts/thumbnails/resized_' . $about->image->name))
                                : asset('placeholders/post.png') }}"
                                alt="" class="card-img-top">
                            <div class="card-body p-2">
                                <h3 class="m-0 mb-1">{{ Str::limit($about->title, 60) }}</h3>
                            </div>

                            <div class="card-body p-2 text-center">
                                <h3 class="m-0 mb-1">
                                    @if ($about->approved)
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
                                                class="icon icon-tabler icon-tabler-backspace" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M20 6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-11l-5 -5a1.5 1.5 0 0 1 0 -2l5 -5z">
                                                </path>
                                                <path d="M12 10l4 4m0 -4l-4 4"></path>
                                            </svg>
                                        </span>
                                    @endif

                                    <span
                                        class="badge badge-default">{{ $about->created_at->isoFormat('D') }}-{{ \Str::ucfirst($about->created_at->isoFormat('MMM')) }}-{{ $about->created_at->isoFormat('Y') }}</span>
                                </h3>
                            </div>

                            <div class="d-flex">
                                <a href="#" class="card-btn btn  btn-primary" wire:click.prevent='readAbout({{ $about->id }})'>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg></a>

                                <a href="{{ route('admin.about.edit', $about->slug) }}" class="card-btn btn btn-warning">
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
                                <a href="" wire:click.prevent="deleteAbout({{ $about->id }})"
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
                        Aucune Rubrique n'est disponible!
                    </span>
                @endforelse
                <div class="d-block mt-4">
                    {{ $abouts->links('livewire::bootstrap') }}
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
                    <h5 class="modal-title">{{ $aboutRead->title ?? '' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="container mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ $aboutRead
                                ? (\Illuminate\Support\Str::startsWith($aboutRead->image->path, 'placeholders/')
                                    ? asset('placeholders/post.png')
                                    : asset('storage/abouts/'. $aboutRead->image->name))
                                : 'https://via.placeholder.com/300x200' }}"
                                class="img-fluid rounded" alt="{{ $aboutRead->title ?? '' }}" style="width: 1140px;">
                        </div>
                        <hr class="bg-dark">
                        <div class="col-md-12 mt-4">
                            <p>{!! $aboutRead ? $aboutRead->content : '' !!}</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
