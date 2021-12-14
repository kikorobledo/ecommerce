<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Department;

class DeparmentComponent extends Component
{

    public $departments;
    public $department;
    public $createForm = [
        'name' => ''
    ];
    public $editForm = [
        'open' => false,
        'name' => ''
    ];

    protected $listeners = ['delete'];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'editForm.name' => 'nombre',
    ];

    public function getDepartments(){

        $this->departments = Department::all();
    }

    public function mount(){

        $this->getDepartments();

    }

    public function save(){

        $this->validate([
            'createForm.name' => 'required'
        ]);

        Department::create($this->createForm);

        $this->reset('createForm');

        $this->getDepartments();

        $this->emit('saved');
    }

    public function edit(Department $department){

        $this->resetValidation();

        $this->department = $department;

        $this->editForm['open'] = true;
        $this->editForm['name'] = $department->name
        ;
    }

    public function update(){

        $this->validate([
            'editForm.name' => 'required'
        ]);

        $this->department->name= $this->editForm['name'];

        $this->department->save();

        $this->reset('editForm');

        $this->getDepartments();
    }

    public function delete(Department $department){

        $department->delete();

        $this->getDepartments();

    }

    public function render()
    {
        return view('livewire.admin.deparment-component')->layout('layouts.admin');
    }
}
