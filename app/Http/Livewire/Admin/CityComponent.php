<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use Livewire\Component;
use App\Models\District;

class CityComponent extends Component
{

    public $city;
    public $districts;
    public $district;
    public $createForm = [
        'name' => '',
    ];
    public $editForm = [
        'open' => false,
        'name' => '',
    ];

    protected $listeners = ['delete'];

    protected $validationAttributes = [
        'createForm.name' => 'nombre',
        'editForm.name' => 'nombre'
    ];

    public function getDistricts(){

        $this->districts = District::where('city_id', $this->city->id)->get();
    }

    public function save(){

        $this->validate([
            'createForm.name' => 'required',
        ]);

        District::create([
            'name' => $this->createForm['name'],
            'city_id' => $this->city->id,
        ]);

        $this->reset('createForm');

        $this->getDistricts();

        $this->emit('saved');
    }

    public function edit(District $district){

        $this->resetValidation();

        $this->district = $district;

        $this->editForm['open'] = true;
        $this->editForm['name'] = $district->name;

    }

    public function update(){

        $this->validate([
            'editForm.name' => 'required',
        ]);

        $this->district->name= $this->editForm['name'];

        $this->district->save();

        $this->reset('editForm');

        $this->getDistricts();
    }

    public function delete(District $district){

        $district->delete();

        $this->getDistricts();

    }


    public function mount(City $city){

        $this->city = $city;

        $this->getDistricts();

    }

    public function render()
    {
        return view('livewire.admin.city-component')->layout('layouts.admin');
    }
}
