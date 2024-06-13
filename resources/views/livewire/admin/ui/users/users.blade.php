<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div>
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center mb-2">
                    <div class="col">
                        <h2 class="page-title">
                            Tous Les Utilisateurs
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="d-flex">
                            <input type="search" class="form-control d-inline-block w-9 me-3"
                                   placeholder="Cherchez un Utilisateur" wire:model='search'>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                               data-bs-target="#modal-user">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Nouveau Utilisateur
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xl">
            <div class="row row-cards mb-4">
                @forelse ($users as $user)
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body p-4 text-center">
                                    <span class="avatar avatar-xl mb-3 rounded"
                                          style="background-image: url({{ $user->image ?
                                    (\Illuminate\Support\Str::startsWith($user->image->path,'placeholders/')? asset($user->image->path) : asset('storage/' . $user->image->path))
                                    : asset('placeholders/picture.jpg') }})"></span>
                                <h3 class="m-0 mb-1"><a href="javascript:void(0)">{{ $user->name . ' ' . $user->sname }}</a>
                                </h3>
                                <div class="text-muted">{{ $user->email }}</div>
                                <div class="mt-3">
                                    <span class="badge bg-purple-lt">{{ Str::ucfirst($user->role->name??'') }}</span>

                                    <span class="badge bg-success-lt">{{ Str::ucfirst($user->typeUser? $user->typeUser->name : '') }}</span>
                                    <hr class="info">
                                    <div class="text-muted">{{ $user->fonction->name??'' }}</div>
                                </div>
                                @if($user->posts_count)
                                    <div class="mt-3">
                                        <span class="badge bg-purple-lt">Auteur</span>
                                        <span class="badge bg-success-lt">{{ $user->posts_count }} Articles</span>
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex">
                                <a href="#" wire:click.prevent='editUser({{ $user }})' class="card-btn">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor" fill="none" stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path
                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                        </path>
                                        <path d="M16 5l3 3"></path>
                                    </svg>
                                    Editer
                                </a>
                                <a href="#" class="card-btn" wire:click.prevent='deleteUser({{ $user }})'>
                                    <!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7l16 0"></path>
                                        <path d="M10 11l0 6"></path>
                                        <path d="M14 11l0 6"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <span class="text-danger">Aucun Utilisateur n'est trouvé!</span>
                @endforelse
            </div>

            <div class="row mt-4">
                {{ $users->links('livewire::bootstrap') }}
            </div>



        </div>
    </div>

    {{-- MODAL ADDING MEMBER --}}

    <div wire:ignore.self class="modal modal-blur fade" id="modal-user" tabindex="-1" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Création d'un Nouveau Utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='addUser()' method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nom d'utilisateur</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="Nom d'utilisateur" wire:model='name'>
                                    <span class="text-danger">
                                            @error('name')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Post Nom</label>
                                    <input type="text" class="form-control" name="sname"
                                           placeholder="Post Nom d'utilisateur" wire:model='sname'>
                                    <span class="text-danger">
                                            @error('sname')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Prenom</label>
                                    <input type="text" class="form-control" name="lname"
                                           placeholder="Post Nom d'utilisateur" wire:model='lname'>
                                    <span class="text-danger">
                                            @error('lname')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">email</label>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="email d'utilisateur" wire:model='email'>
                                    <span class="text-danger">
                                            @error('email')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Téléphone</label>
                                    <input type="phone" class="form-control" name="phone"
                                           placeholder="Numero Tel d'utilisateur" wire:model='phone'>
                                    <span class="text-danger">
                                            @error('phone')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Qui est-il?</div>
                                    <div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   checked="" value="m" wire:model='gender'>
                                            <span class="form-check-label">Homme</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   value="f" wire:model='gender'>
                                            <span class="form-check-label">Femme</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   value="p" wire:model='gender'>
                                            <span class="form-check-label">Perso morale</span>
                                        </label>
                                        <span class="text-danger">
                                                @error('gender')
                                            {{ $message }}
                                            @enderror
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status du Membre</label>
                                    <select id="countries" class="form-control form-select" wire:model="type_user_id">
                                        <option value="">-- Choisissez le status du membre --</option>
                                        @foreach (\App\Models\TypeUser::all() as $typeUser)
                                            <option value="{{ $typeUser->id }}">{{ $typeUser->name }}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger">
                                            @error('type_user_id')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Role du Membre dans le système</label>
                                    <select id="countries" class="form-control form-select" wire:model='role'>
                                        <option value="">-- Choisissez le role d'Utilisateur --</option>
                                        @foreach (\App\Models\Role::all() as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Fonction d'Utilisateur</label>
                                    <select id="fonction" class="form-control form-select" wire:model="fonction">
                                        <option class="text-lg-start" value="">-- choisissez la Fonction d'Utilisateur --</option>
                                        @foreach (\App\Models\Fonction::all() as $fonction)
                                            <option value="{{ $fonction->id }}">{{ $fonction->name }}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger">
                                            @error('$fonction')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Création d'utilisateur
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- MODAL EDITING MEMBER --}}

    <div wire:ignore.self class="modal modal-blur fade" id="modal-user-edit" tabindex="-1" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase">Edition d'Utilisateur {{ $name }} {{ $sname }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='updateUser()' method="post">
                    <input type="hidden" wire:model='selected_user_id'>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nom d'utilisateur</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="Nom d'Utilisateur" wire:model='name'>
                                    <span class="text-danger">
                                            @error('name')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Post Nom</label>
                                    <input type="text" class="form-control" name="sname"
                                           placeholder="Post Nom d'Utilisateur" wire:model='sname'>
                                    <span class="text-danger">
                                            @error('sname')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Prenom</label>
                                    <input type="text" class="form-control" name="lname"
                                           placeholder="Post Nom du membre" wire:model='lname'>
                                    <span class="text-danger">
                                            @error('lname')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">email</label>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="email du membre" wire:model='email'>
                                    <span class="text-danger">
                                            @error('email')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Téléphone</label>
                                    <input type="phone" class="form-control" name="phone"
                                           placeholder="Numero Tel du membre" wire:model='phone'>
                                    <span class="text-danger">
                                            @error('phone')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-label">Qui est-il?</div>
                                    <div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   checked="" value="m" wire:model='gender'>
                                            <span class="form-check-label">Homme</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   value="f" wire:model='gender'>
                                            <span class="form-check-label">Femme</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender"
                                                   value="p" wire:model='gender'>
                                            <span class="form-check-label">Perso morale</span>
                                        </label>
                                        <span class="text-danger">
                                                @error('gender')
                                            {{ $message }}
                                            @enderror
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status du Membre </label>
                                    <select id="status" class="form-control form-select" wire:model='type_user_id'>
                                        @foreach (\App\Models\TypeUser::all() as $typeUser)
                                            <option value="{{ $typeUser->id }}">{{ $typeUser->name }}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger">
                                            @error('type_user_id')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Role du Membre dans le système </label>
                                    <select id="status" class="form-control form-select" wire:model='role'>
                                        @foreach (\App\Models\Role::all() as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Fonction d'Utilisateur</label>
                                    <select id="fonction" class="form-control form-select" wire:model="fonction">
                                        <option value="">-- Choisissez la Fonction d'Utilisateur --</option>
                                        @foreach (\App\Models\Fonction::all() as $fonction)
                                            <option value="{{ $fonction->id }}">{{ $fonction->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                            @error('$fonction')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Mettre à jour les données d'utilisateur
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
