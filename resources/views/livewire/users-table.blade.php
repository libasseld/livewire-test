<div x-data="{selection: @entangle('selection').defer}">
    @dump($selection)

    <span x-html="JSON.stringify(selection)"></span>
    <div class="field">
        <p class="control has-icons-left has-icons-right ">
            <input class="input" type="email" wire:model.debounce.500ms="search" placeholder="rechercher un membre">
            <span class="icon is-small is-left">
                <ion-icon name="search"></ion-icon>
            </span>
        </p>
    </div>
    <button class="button is-danger" x-show="selection.length >0 " x-on:click="$wire.deleteUsers(selection)">Supprimer</button>
    <table  class="table is-fullwidth has-text-gray">
        <thead>
        <tr>
            <th></th>
            <x-table-header :direction="$orderDirection" name="name" :field="$orderField">Name</x-table-header>
            <x-table-header :direction="$orderDirection" name="job" :field="$orderField">Title</x-table-header>
            <x-table-header :direction="$orderDirection" name="active" :field="$orderField">Status</x-table-header>
            <x-table-header :direction="$orderDirection" name="role" :field="$orderField">Rôle</x-table-header>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    <input type="checkbox" x-model="selection" value="{{ $user->id }}" />
                </td>
                <td>
                    <div class="is-flex">
                        <figure class="image is-48x48">
                            <img class="is-rounded" src="https://ui-avatars.com/api/?name={{$user->name}}&background=random">
                        </figure>
                        <div class="ml-4">
                                <span class="has-text-black has-text-weight-bold">
                                    {{ $user->name}}
                                </span> <br>
                            {{ $user->email }}

                        </div>
                    </div>
                </td>
                <td>
                         <span class="has-text-black has-text-weight-bold">
                            {{ $user->job}}
                         </span> <br>
                    {{ $user->groupe }}

                </td>
                <td>
                    @if($user->active)
                        <span class="tag is-success is-light"> Actif</span>
                    @else
                        <span class="tag is-danger is-light"> Inactif</span>
                    @endif
                </td>
                <td>
                    {{ $user->role }}
                </td>
                <td>
                    <button class="button" wire:click="startEdit({{ $user->id  }})">Editer</button>
                </td>
            </tr>
            @if($editId === $user->id)
                <tr>
                    <livewire:user-form :user="$user" :key="$user->id" />
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
</div>