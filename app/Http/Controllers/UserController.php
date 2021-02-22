<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $curUser = auth()->user();

        //все сотрудники
        $users = User::all();

        return view('users.index', compact('curUser', 'users'));
    }

    //информация о сотруднике
    public function show(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user)
            return redirect('/');

        //$orders - все заказы сотрудника, $ordersCount - кол-во всех заказов, $ordersDone - кол-во выполненных, $ordersNotDone - кол-во не выполненных
        $orders = Order::where('user_id', $id);
        $ordersCount = $orders->count();
        $ordersCountDone = $orders->where('status', true)->count();
        $ordersCountNotDone = $ordersCount - $ordersCountDone;

        //последние 5 выполненных заказов
        $latest_orders = $orders->where('status', true)->take(5);

        return view('users.show', compact('user', 'orders',
            'ordersCount', 'ordersCountDone', 'ordersCountNotDone'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('auth.register', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validated($request, $user);

        if($data['position_id'] == 1)
        {
            $role = 'administrator';
        }
        else{
            $role = 'personnel';
        }

        $user['role'] = $role;
        $user->update($data);

        return redirect()->route('users.show', $user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index');
    }

    protected function validated(Request $request, User $user = null)
    {
        $rules = [
            'name' => 'required|min:5|max:100|unique:users',
            'email' => 'required',
            'full_name' => 'required',
            'position_id' => 'nullable',
            'address' => 'nullable',
            'phone_number' => 'nullable',
        ];

        if($user)
            $rules['name'] .= ',name,' . $user->id;

        return $request->validate($rules);
    }
}
