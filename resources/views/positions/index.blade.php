@extends('layouts.app')

@section('header')
    <h3>Должности
        <div class="mt-2">
            <a href="{{ route('positions.create') }}" class="ml-auto btn btn-success">
                Добавить должность
            </a>
        </div>
    </h3>

@endsection

@section('content')

    @forelse($positions as $position)
        @if($loop->first)
            <table class="table table-bordered table-striped">
                <thead class="thead-inverse">
                <tr>
                    <th scope="col">Наименование должности</th>
                    <th scope="col">Оклад</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
        @endif
                <tr>
                    <td>
                        {{ $position->name }}
                    </td>
                    <td>
                        {{ $position->salary }}
                    </td>
                    @if(Auth::user()->is_admin())
                        <form class="ml-auto" action="{{ route('positions.destroy', $position) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('update', $position)
                                <td>
                                    <a class="btn btn-info" href="{{ route('positions.edit', $position) }}">
                                        Редактировать
                                    </a>
                                </td>
                            @endcan
                            @can('delete', $position)
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
            Пока нет ни одной должности :(
            Но Вы можете это исправить, создав новую должность :)
        </div>
    @endforelse
@endsection
