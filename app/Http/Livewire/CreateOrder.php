<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Order;
use Livewire\Component;
use App\Models\District;
use App\Models\Department;
use Gloudemans\Shoppingcart\Facades\Cart;

class CreateOrder extends Component
{

    public $departments;
    public $cities = [];
    public $districts = [];
    public $department_id = "";
    public $city_id = "";
    public $district_id = "";
    public $address;
    public $reference;
    public $envio_type = 1;
    public $contact;
    public $phone;
    public $shipping_cost = 0;

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required',

    ];

    public function mount(){

        $this->departments = Department::all();

    }

    public function updatedDepartmentId($value){

        $this->cities = City::where('department_id', $value)->get();

        $this->reset(['city_id', 'district_id','shipping_cost']);

    }

    public function updatedCityId($value){

        $city = City::find($value);

        $this->districts = District::where('city_id', $value)->get();

        $this->shipping_cost = $city->cost;

        $this->reset(['district_id']);

    }

    public function updatedEnvioType($value){

        if($value == 1){

            $this->resetValidation([
                'department_id',
                'city_id',
                'district_id',
                'address',
                'reference'
            ]);

        }

    }

    public function createOrder(){

        $rules = $this->rules;

        if($this->envio_type == 2){

            $rules['department_id'] = 'required';
            $rules['city_id'] = 'required';
            $rules['district_id'] = 'required';
            $rules['address'] = 'required';
            $rules['reference'] = 'required';

        }

        $this->validate($rules);

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->envio_type = $this->envio_type;
        $order->shipping_cost = 0;
        $order->total = $this->shipping_cost + Cart::subtotal();
        $order->content = Cart::content();
        $order->address ="";
        $order->reference ="";

        if($this->envio_type == 2){

            /* $order->department_id = $this->department_id;
            $order->city_id = $this->city_id;
            $order->district_id = $this->district_id;
            $order->address = $this->address;
            $order->reference = $this->reference; */
            $order->shipping_cost = $this->shipping_cost;
            $order->envio =json_encode([
                'department' => Department::find($this->department_id)->name,
                'city' => City::find($this->city_id)->name,
                'district' => District::find($this->district_id)->name,
                'address' => $this->address,
                'reference' => $this->reference,
            ]);

        }

        $order->save();

        foreach (Cart::content() as $item) {

            discount($item);

        }

        Cart::destroy();

        return redirect()->route('orders.payment', $order);

    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
