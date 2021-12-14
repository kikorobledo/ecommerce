<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use Livewire\Component;
use App\Models\Department;

class ShowDepartment extends Component
{
    public $department;
    public $cities;
    public $city;
    public $createForm = [
        'name' => '',
        'cost' => null
    ];
    public $editForm = [
        'open' => false,
        'name' => '',
        'cost' => null
    ];

    protected $listeners = ['delete'];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'editForm.name' => 'nombre',
        'createForm.cost' => 'costo',
        'editForm.cost' => 'costo',
    ];

    public function getCities(){

        $this->cities = City::where('department_id', $this->department->id)->get();
    }

    public function mount(Department $department){

        $this->department = $department;

        $this->getCities();

    }

    public function save(){

        $this->validate([
            'createForm.name' => 'required',
            'createForm.cost' => 'required'
        ]);

        City::create([
            'name' => $this->createForm['name'],
            'cost' => $this->createForm['cost'],
            'department_id' => $this->department->id,
        ]);

        $this->reset('createForm');

        $this->getCities();

        $this->emit('saved');
    }

    public function edit(City $city){

        $this->resetValidation();

        $this->city = $city;

        $this->editForm['open'] = true;
        $this->editForm['name'] = $city->name;
        $this->editForm['cost'] = $city->cost;
    }

    public function update(){

        $this->validate([
            'editForm.name' => 'required',
            'editForm.cost' => 'required'
        ]);

        $this->city->name= $this->editForm['name'];
        $this->city->cost= $this->editForm['cost'];

        $this->city->save();

        $this->reset('editForm');

        $this->getCities();
    }

    public function delete(City $city){

        $city->delete();

        $this->getCities();

    }

    public function render()
    {
        return view('livewire.admin.show-department')->layout('layouts.admin');
    }
}
