@extends('layouts.app')

@section('header')
    <h3>Ингредиенты
        <div class="mt-2">
            <a href="{{ route('ingredients.create') }}" class="ml-auto btn btn-success">
                Добавить ингредиент
            </a>
        </div>
    </h3>
@endsection

@section('content')

    @forelse($ingredients as $ingredient)
        @if($loop->first)
            <table class="table table-bordered table-striped">
                <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Доступное количество</th>
                    <th scope="col">Блюда</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @endif
                <tr>
                    <th scope="row"></th>
                    <td>
                        {{ $ingredient->name }}
                    </td>
                    <td>
                        {{ $ingredient->price }}
                    </td>
                    <td>
                        {{ $ingredient->available_quantity }}
                    </td>
                    <td>
                        {{ $ingredient->dishes()->pluck('name')->implode(', ')  }}
                    </td>
                    @if(Auth::user()->is_admin())
                        <form class="ml-auto" action="{{ route('ingredients.destroy', $ingredient) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('update', $ingredient)
                                <td>
                                    <a class="btn btn-info" href="{{ route('ingredients.edit', $ingredient) }}">
                                        Редактировать
                                    </a>
                                </td>
                            @endcan
                            @can('delete', $ingredient)
                                <td>
                                    <button class="btn btn-danger">
                                        Удалить
                                    </button>
                                </td>
                            @endcan
                        </form>
                    @endif
                </tr>
                @if($loop->last)
                </tbody>
            </table>
        @endif

    @empty
        <div class="alert alert-secondary">
            Пока нет ни одного ингредиента :(
            Но Вы можете это исправить, добавив новый ингредиент :)
        </div>
    @endforelse
@endsection
