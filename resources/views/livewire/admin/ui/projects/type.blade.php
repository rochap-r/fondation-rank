<div>
    {{-- In work, do what you enjoy. --}}

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Liste des Types de Projets</h4>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#type_modal">Ajouter un type de
                projet</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th style="font-size: 16px;">Nom</th>
                            <th style="font-size: 16px;">Projets</th>
                            <th style="font-size: 16px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($types as $type)
                            <tr wire:key="{{ $type->id }}">
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->projects_count }}</td>
                            
                                <td>
                                    <div class="btn-group text-md">
                                        <a href="#" class="btn btn-md  btn-primary" wire:click.prevent='editType({{ $type->id }})'>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                                <path d="M13.5 6.5l4 4"></path>
                                            </svg>
                                            Editer
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="#" wire:click.prevent="deleteType({{ $type->id }})" class="btn btn-md  btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 7l16 0"></path>
                                                <path d="M10 11l0 6"></path>
                                                <path d="M14 11l0 6"></path>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                            </svg>
                                            Effacer
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <span class="text-danger">Aucun de Type de Projet n'est
                                        disponible</span>
                                </td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="4">
                                <div class="d-block mt-2">
                                    {{ $types->links('livewire::bootstrap') }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- model de creation et mise à jour des types de projets !-->
    <div wire:ignore.self class="modal modal-blur fade" id="type_modal" tabindex="-1" aria-hidden="true"
        style="display: none;" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST"
                @if ($updateTypeMode) wire:submit.prevent='updateType()' @else wire:submit.prevent='addType()' @endif>

                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $updateTypeMode ? 'Mise à jour du Type de Projet ' . $name . '' : 'Création d\'un nouveau Type de Projet' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    @if ($updateTypeMode === true)
                        <input type="hidden" wire:model='selected_id'>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Nom du Type</label>
                        <input type="text" class="form-control" name="name"
                            placeholder="Saisissez un type de projet" wire:model='name'>
                        <span class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit"
                        class="btn btn-primary">{{ $updateTypeMode ? 'Sauvegarder' : 'Enregistrer' }}</button>
                </div>
            </form>
        </div>
    </div>

</div>
    