<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Dish;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        //все заказы
        $orders = Order::all();

        return view('orders.index', compact('user', 'orders'));
    }

    public function create()
    {
        $this->authorize('create', Order::class);

        $dishes = Dish::all();
        $clients = Client::all();
        $users = User::all();

        return view('orders.form', compact('dishes', 'clients', 'users'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Order::class);

        $order = Order::create($request->all());

        if($request->input('dishes')):
            $order->dishes()->attach($request->input('dishes'));
        endif;

        return redirect()->route('orders.show', $order);
    }

    public function show(Order $order)
    {
        $amount_order = $order->dishes->sum('price');

        return view('orders.show', compact('order', 'amount_order'));
    }

    public function edit(Order $order)
    {
        $this->authorize('update', $order);

        $dishes = Dish::all();
        $clients = Client::all();
        $users = User::all();

        return view('orders.form', compact('order', 'dishes', 'clients', 'users'));
    }

    public function update(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $order->update($request->all());
        $order->dishes()->detach();

        if($request->input('dishes')):
            $order->dishes()->attach($request->input('dishes'));
        endif;

        return redirect()->route('orders.show', $order);
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);

        $order->dishes()->detach();
        $order->delete();

        return redirect()->route('orders.index');
    }

    public function toggle(Order $order)
    {
        $this->authorize('update', $order);

        $order->status = !$order->status;
        $order->save();

        return redirect()->route('orders.show', $order);
    }
}
