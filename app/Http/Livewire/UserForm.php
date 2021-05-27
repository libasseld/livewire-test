<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
class UserForm extends Component
{
    public User $user;

    protected $rules = [
        'user.name' => 'required|string|min:6'
    ];

    public function save(){
        $this->validate();
        $this->user->save();
        $this->emit('userUpdated');
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
