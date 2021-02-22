@extends('layouts.app')

@section('header')
    <h3>Блюда
        <div class="mt-2">
            <a href="{{ route('dishes.create') }}" class="ml-auto btn btn-success">
                Добавить блюдо
            </a>
        </div>
    </h3>
@endsection

@section('content')

    @forelse($dishes as $dish)
        @if($loop->first)
            <table class="table table-bordered table-striped">
                <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Состав</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @endif
                <tr>
                    <th scope="row"></th>
                    <td>
                        <a href="{{ route('dishes.show', $dish) }}">
                            {{ $dish->name }}
                        </a>
                    </td>
                    <td>
                        {{ $dish->price }}
                    </td>
                    <td>
                        {{ $dish->ingredients()->pluck('name')->implode(', ') }}
                    </td>
                    <td>
                        <a class="btn btn-secondary" href="{{ route('dishes.show', $dish) }}">
                            Подробнее
                        </a>
                    </td>
                    @if(Auth::user()->is_admin())
                        <form class="ml-auto" action="{{ route('dishes.destroy', $dish) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('update', $dish)
                                <td>
                                    <a class="btn btn-info" href="{{ route('dishes.edit', $dish) }}">
                                        Редактировать
                                    </a>
                                </td>
                            @endcan
                            @can('delete', $dish)
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
            Пока нет ни одного блюда :(
            Но Вы можете это исправить, добавив новое блюдо :)
        </div>
    @endforelse
@endsection
