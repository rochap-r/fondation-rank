<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <form  method="post" wire:submit.prevent='changePassword()'>
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Ancien Mot de Passe</label>
                    <input type="password" class="form-control" name="passwordA" placeholder="Ancien mot de passe" wire:model="passwordA">
                    <span class="text-danger">@error('passwordA'){{ $message }}@enderror</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Nouveau Mot de Passe</label>
                    <input type="password" class="form-control" name="password" placeholder="Nouveau mot de passe" wire:model="password">
                    <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">rétaper le nouveau Mot de Passe</label>
                    <input type="password" class="form-control" name="passwordC" placeholder="rétaper le nouveau Mot de Passe" wire:model="passwordC">
                    <span class="text-danger">@error('passwordC'){{ $message }}@enderror</span>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Changer le mot de passe</button>
    </form>
    
</div>
