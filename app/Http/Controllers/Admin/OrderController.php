<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::query()->where('status', '<>', 1);

        if(request('status')){
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $statuses = [
            'pendiente' => Order::where('status', 1)->count(),
            'recibido' => Order::where('status', 2)->count(),
            'enviado' => Order::where('status', 3)->count(),
            'entregado' => Order::where('status', 4)->count(),
            'anulado' => Order::where('status', 5)->count()
        ];

        return view('admin.orders.index', compact('orders', 'statuses'));

     }

     public function show(Order $order){

        return view('admin.orders.show', compact('order'));

     }
}
