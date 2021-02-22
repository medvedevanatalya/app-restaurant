<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        //все столики
        $tables = Table::all();

        return view('tables.index', compact('user', 'tables'));
    }

    public function create()
    {
        $this->authorize('create', Table::class);

        return view('tables.form');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Table::class);

        $data = $this->validated($request);

        Table::create($data);

        return redirect()->route('tables.index');
    }

    public function show(Table $table)
    {
        //
    }

    public function edit(Table $table)
    {
        $this->authorize('update', $table);

        return view('tables.form', compact('table'));
    }

    public function update(Request $request, Table $table)
    {
        $this->authorize('update', $table);

        $data = $this->validated($request, $table);

        $table->update($data);

        return redirect()->route('tables.index');
    }

    public function destroy(Table $table)
    {
        $this->authorize('delete', $table);

        $table->delete();

        return redirect()->route('tables.index');
    }

    protected function validated(Request $request, Table $table = null)
    {
        $rules = [
            'name' => 'required|min:1|max:255'
        ];

        $messages = [
            'name.required' => 'Поле "Название" обязательно для заполнения',
            'name.min' => 'Поле "Название" должно содержать минимум 1 символ',
            'name.max' => 'Поле "Название" должно содержать максимум 255 символов',
        ];

        if($table)
            $rules['name'] .= ',name,' . $table->id;

        return $request->validate($rules, $messages);
    }
}
