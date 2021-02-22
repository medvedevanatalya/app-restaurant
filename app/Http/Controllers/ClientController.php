<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        //все должности
        $clients = Client::all();

        return view('clients.index', compact('user', 'clients'));
    }

    public function create()
    {
        $this->authorize('create', Client::class);

        return view('clients.form');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Client::class);

        $data = $this->validated($request);

        Client::create($data);

        return redirect()->route('clients.index');
    }

    public function show(Client $client)
    {
        //
    }

    public function edit(Client $client)
    {
        $this->authorize('update', $client);

        return view('clients.form', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        $data = $this->validated($request, $client);

        $client->update($data);

        return redirect()->route('clients.index');
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return redirect()->route('clients.index');
    }

    protected function validated(Request $request, Client $client = null)
    {
        $rules = [
            'full_name' => 'required|min:5|max:255',
            'phone_number' => 'numeric'
        ];

        $messages = [
            'full_name.required' => 'Поле "ФИО" обязательно для заполнения',
            'full_name.min' => 'Поле "ФИО" должно содержать минимум 5 символов',
            'full_name.max' => 'Поле "ФИО" должно содержать максимум 255 символов',
            'phone_number.numeric' => 'Поле "Номер телефона" должно содержать только числа',
        ];

        if($client)
            $rules['full_name'] .= ',full_name,' . $client->id;

        return $request->validate($rules, $messages);
    }
}
