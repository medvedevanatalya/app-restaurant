<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        //все должности
        $ingredients = Ingredient::all();

        return view('ingredients.index', compact('user', 'ingredients'));
    }

    public function create()
    {
        $this->authorize('create', Ingredient::class);

        return view('ingredients.form');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Ingredient::class);

        $data = $this->validated($request);

        Ingredient::create($data);

        return redirect()->route('ingredients.index');
    }

    public function show(Ingredient $ingredient)
    {
        //
    }

    public function edit(Ingredient $ingredient)
    {
        $this->authorize('update', $ingredient);

        return view('ingredients.form', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $this->authorize('update', $ingredient);

        $data = $this->validated($request, $ingredient);

        $ingredient->update($data);

        return redirect()->route('ingredients.index');
    }

    public function destroy(Ingredient $ingredient)
    {
        $this->authorize('delete', $ingredient);

        $ingredient->delete();

        return redirect()->route('ingredients.index');
    }

    protected function validated(Request $request, Ingredient $ingredient = null)
    {
        $rules = [
            'name' => 'required|min:2|max:255',
            'price' => 'required',
            'available_quantity' => 'required'
        ];

        $messages = [
            'name.required' => 'Поле "Название" обязательно для заполнения',
            'name.min' => 'Поле "Название" должно содержать минимум 2 символа',
            'name.max' => 'Поле "Название" должно содержать максимум 255 символов',
            'price.required' => 'Поле "Цена" обязательно для заполнения',
            'available_quantity.required' => 'Поле "Доступное количество" обязательно для заполнения'
        ];

        if($ingredient)
            $rules['name'] .= ',name,' . $ingredient->id;

        return $request->validate($rules, $messages);
    }
}
