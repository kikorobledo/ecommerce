<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{

    use WithPagination;

    public $search;

    public function updatingSearch(){

        $this->reset('page');

    }

    public function assingRole(User $user, $value){

        if($value == 1){

            $user->assignRole('admin');
        }else{
            $user->removeRole('admin');
        }

    }

    public function render()
    {
        $users = User::where('email', '!=', auth()->user()->email)
                        ->where(function($query){
                            $query->where('name', 'like', '%' . $this->search . '%')
                            ->orwhere('email', 'like', '%' . $this->search . '%');
                        })
                        ->paginate(10);

        return view('livewire.admin.user-component', compact('users'))->layout('layouts.admin');
    }
}
