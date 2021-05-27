<td colspan="6">
    <form action="" wire:submit.prevent="save">
        <div class="field">
            <label for="name" class="label">Name</label>
            <div class="control">
                <input type="text" wire:model.defer="user.name" class="input">
            </div>
            @error('user.name')
                <span class="help is-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="buttons">
            <button class="button is-primary" type="submit" wire:loading.attr="disabled"> Sauvegarder</button>
        </div>
    </form>
</td>