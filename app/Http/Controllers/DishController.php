<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        //все блюда
        $dishes = Dish::all();

        return view('dishes.index', compact('user', 'dishes'));
    }

    public function create()
    {
        $this->authorize('create', Dish::class);

        $ingredients = Ingredient::all();

        return view('dishes.form', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Dish::class);

        $data = $this->validated($request);

        $dish = Dish::create($data);

        if($request->input('ingredients')):
            $dish->ingredients()->attach($request->input('ingredients'));
        endif;

        return redirect()->route('dishes.show', $dish);
    }

    public function show(Dish $dish)
    {
        return view('dishes.show', compact('dish'));
    }

    public function edit(Dish $dish)
    {
        $this->authorize('update', $dish);

        $ingredients = Ingredient::all();

        return view('dishes.form', compact('dish', 'ingredients'));
    }

    public function update(Request $request, Dish $dish)
    {
        $this->authorize('update', $dish);

        $data = $this->validated($request, $dish);

        $dish->update($data);
        $dish->ingredients()->detach();

        if($request->input('ingredients')):
            $dish->ingredients()->attach($request->input('ingredients'));
        endif;

        return redirect()->route('dishes.show', $dish);
    }

    public function destroy(Dish $dish)
    {
        $this->authorize('delete', $dish);

        $dish->ingredients()->detach();
        $dish->delete();

        return redirect()->route('dishes.index');
    }

    protected function validated(Request $request, Dish $dish = null)
    {
        $rules = [
            'name' => 'required|min:3|max:255',
            'price' => 'required'
        ];

        $messages = [
            'name.required' => 'Поле "Название" обязательно для заполнения',
            'name.min' => 'Поле "Название" должно содержать минимум 3 символа',
            'name.max' => 'Поле "Название" должно содержать максимум 255 символов',
            'price.required' => 'Поле "Цена" обязательно для заполнения',
        ];

        if($dish)
            $rules['name'] .= ',name,' . $dish->id;

        return $request->validate($rules, $messages);
    }
}
