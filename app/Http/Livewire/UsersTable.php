<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public string $search = "";
    public string $orderField = "name";
    public string $orderDirection = "ASC";
    public int $editId = 0;
    protected $queryString = [
        'search' => ['except' => ''],
        'orderField' => ['except' => 'name'],
        'orderDirection' => ['except' => 'ASC']
    ];
    protected $listeners = [
        'userUpdated' => 'onUserUpdated'
    ];

    public function onUserUpdated(){
        $this->reset('editId');
    }

    public function paginationView(){
        return 'livewire.pagination';
    }

    public function startEdit(int $id){
        $this->editId = $id;
    }

    public function setOrderField(string $name){
        if ($name === $this->orderField){
            $this->orderDirection = $this->orderDirection === 'ASC' ? 'DESC' : 'ASC';
        }else{
            $this->orderField = $name;
            $this->reset('orderDirection');
        }
    }

    public function updating($name, $value){
        if ($name === 'search'){
            $this->resetPage();
        }
    }
    public function render()
    {
        return view('livewire.users-table', [
            'users' => User::where('name', 'LIKE',"%{$this->search}%")
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(5)
        ]);
    }
}
