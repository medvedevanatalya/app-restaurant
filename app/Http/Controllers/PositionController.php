<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PositionController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        //все должности
        $positions = Position::all();

        return view('positions.index', compact('user', 'positions'));
    }

    public function create()
    {
        $this->authorize('create', Position::class);

        return view('positions.form');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Position::class);

        $data = $this->validated($request);
;
        Position::create($data);

        return redirect()->route('positions.index');
    }

    public function show(Position $position)
    {

    }

    public function edit(Position $position)
    {
        $this->authorize('update', $position);

        return view('positions.form', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $this->authorize('update', $position);

        $data = $this->validated($request, $position);

        $position->update($data);

        return redirect()->route('positions.index');
    }

    public function destroy(Position $position)
    {
        $this->authorize('delete', $position);

        $position->delete();

        return redirect()->route('positions.index');
    }

    protected function validated(Request $request, Position $position = null)
    {
        $rules = [
            'name' => 'required|min:5|max:255',
            'salary' => 'required'
        ];

        $messages = [
            'name.required' => 'Поле Должность обязательно для заполнения',
            'name.min' => 'Поле Должность должно содержать минимум 5 символов',
            'name.max' => 'Поле Должность должно содержать максимум 255 символов',
            'salary.required' => 'Поле Оклад обязательно для заполнения'
        ];

        if($position)
            $rules['name'] .= ',name,' . $position->id;

        return $request->validate($rules, $messages);
    }

    public function toggle(Position $position)
    {
//        $this->authorize('update', $position);
//
//        $position->publish = !$position->publish;
//        $position->save();
//
//        return redirect()->route('posts.s protected function validated(Request $request, Position $position = null)
//    {
//        $rules = [
//            'name' => 'required|min:5|max:100|unique:positions',
//            'salary' => 'required'
//        ];
//
//        if($position)
//            $rules['name'] .= ',name,' . $position->id;
//
//        return $request->validate($rules);
//    }how', $position);
    }


}
