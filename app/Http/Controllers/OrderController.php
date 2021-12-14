<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    public function index(){

        $orders = Order::query()->where('user_id', auth()->user()->id);

        if(request('status')){
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $statuses = [
            'pendiente' => Order::where('user_id', auth()->user()->id)->where('status', 1)->count(),
            'recibido' => Order::where('user_id', auth()->user()->id)->where('status', 2)->count(),
            'enviado' => Order::where('user_id', auth()->user()->id)->where('status', 3)->count(),
            'entregado' => Order::where('user_id', auth()->user()->id)->where('status', 4)->count(),
            'anulado' => Order::where('user_id', auth()->user()->id)->where('status', 5)->count()
        ];

        return view('orders.index', compact('orders', 'statuses'));

    }

    public function show(Order $order){

        $this->authorize('author', $order);

        $items = json_decode($order->content);
        $envio = json_decode($order->envio);

        return view('orders.show', compact('order', 'items', 'envio'));

    }

    public function pay(Order $order, Request $request){

        $this->authorize('author', $order);

        $payment_id =  $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id". "?access_token=APP_USR-476287462723941-091017-06dfcc376060b3a90b089bbbae97d1c9-822261226");

        $response = json_decode($response);

        $status =  $response->status;

        if($status == 'approved'){

            $order->status = 2;
            $order->save();
        }

        return redirect()->route('orders.show', $order);
    }
}
