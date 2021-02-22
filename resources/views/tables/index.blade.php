@extends('layouts.app')

@section('header')
    <h3>Столики
        <div class="mt-2">
            <a href="{{ route('tables.create') }}" class="ml-auto btn btn-success">
                Добавить столик
            </a>
        </div>
    </h3>
@endsection

@section('content')

    @forelse($tables as $table)
        @if($loop->first)
            <table class="table table-bordered table-striped">
                <thead class="thead-inverse">
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @endif
                <tr>
                    <td>
                        {{ $table->name }}
                    </td>

                    @if(Auth::user()->is_admin())
                        <form class="ml-auto" action="{{ route('tables.destroy', $table) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('update', $table)
                                <td>
                                    <a class="btn btn-info" href="{{ route('tables.edit', $table) }}">
                                        Редактировать
                                    </a>
                                </td>
                            @endcan
                            @can('delete', $table)
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
            Пока нет ни одного столика :(
            Но Вы можете это исправить, добавив новый столик :)
        </div>
    @endforelse
@endsection
