<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Liste des Projets</h4>
            <div class="d-flex align-items-center">
                <form class="mx-3">
                    <div class="input-group">
                        <input type="text" wire:model.lazy="search" class="form-control"
                            placeholder="Rechercher un projet" required>
                    </div>
                </form>
                <a href="{{ route('admin.project.create') }}" class="btn btn-primary">Ajouter un Projet</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($projects as $project)
                    <div class="col-md-4" wire:key="{{ $project->id }}">
                        <div class="card mt-3">
                            <!-- Image du projet -->
                            <div class="position-relative">
                                <img src="{{ $project->image
                                    ? (\Illuminate\Support\Str::startsWith($project->image->path, 'placeholders/')
                                        ? asset('placeholders/project.png')
                                        : asset('storage/projects/thumbnails/resized_' . $project->image->name))
                                    : 'https://via.placeholder.com/300x200' }}"
                                    class="card-img-top" alt="Image du Projet">

                                <!-- Indication "Nouveau" -->
                                @if ($project->created_at->diffInHours(now()) <= 12)
                                    <span
                                        class="badge bg-success position-absolute top-0 start-0 translate-middle m-2">New</span>
                                @endif
                            </div>

                            <!-- Corps de la carte -->
                            <div class="card-body">
                                <!-- Type de projet -->
                                <span class="badge bg-info text-dark mb-2">{{ $project->typeProject->name }}</span>

                                <!-- Titre du projet -->
                                <h5 class="card-title">{{ Str::limit($project->title, 60) }}</h5>

                                <!-- Objectif et Montant collecté -->
                                <div class="d-flex justify-content-between">
                                    <p class="card-text mb-0">Objectif:
                                        ${{ number_format($project->goal, 0, ',', ' ') }}</p>
                                    <p class="card-text mb-0 text-success">Collecté:
                                        ${{ number_format($project->collected, 0, ',', ' ') }}</p>
                                </div>

                                <!-- Date de création du projet -->
                                <p class="card-text mt-2">Créé {{ $project->created_at->diffForHumans() }}</p>

                                <!-- Bouton pour voir plus de détails -->
                                <a href="" class="btn btn-primary mt-3"
                                    wire:click.prevent='readProject({{ $project->id }})'>Voir plus</a>
                                <a href="{{ route('admin.project.edit', $project->slug) }}"
                                    class="btn btn-warning mt-3">
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
                                <a href="#" wire:click.prevent="deleteProject({{ $project->id }})"
                                    class="btn btn-danger mt-3">
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
                    <div class="alert alert-danger mt-4" role="alert">
                        Aucun projet trouvé.
                    </div>
                @endforelse
            </div>
            <div class="d-block mt-4">
                {{ $projects->links('livewire::bootstrap') }}
            </div>
        </div>
    </div>


    <!-- Modale de la Description du Projet -->
    <div wire:ignore.self class="modal modal-blur fade" id="read_modal" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $projet->title ?? '' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="container mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ $projet
                                ? (\Illuminate\Support\Str::startsWith($projet->image->path, 'placeholders/')
                                    ? asset('placeholders/project.png')
                                    : asset('storage/projects/' . $projet->image->name))
                                : 'https://via.placeholder.com/300x200' }}"
                                class="img-fluid rounded" alt="{{ $projet->title ?? '' }}" style="width: 1140px;">
                        </div>
                        <hr>
                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Détails du Projet</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Objectif :</strong>
                                            {{ $projet->goal ?? '' }}
                                        </li>
                                        <li class="list-group-item"><strong>Collecté :</strong>
                                            {{ $projet->collected ?? '' }}</li>
                                        <li class="list-group-item"><strong>Type de Projet :</strong>
                                            {{ $projet->typeProject->name ?? '' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr class="bg-dark">
                        <div class="col-md-12 mt-4">
                            <p>{!! $projet->description ?? '' !!}</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
