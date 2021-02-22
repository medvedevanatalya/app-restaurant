@extends('layouts.app')

@section('header')
    <h3 class="mb-2">Сотрудники
        <div class="mt-2">
            @if(Auth::user()->is_admin())
                <a href="{{ route('register') }}" class="ml-auto btn btn-success">
                    Добавить сотрудника
                </a>
            @endif
        </div>
    </h3>
@endsection

@section('content')
    @forelse($users as $user)
        @if($loop->first)
            <table class="table table-bordered table-striped">
                <thead class="thead-inverse">
                    <tr>
                        <th scope="col">ФИО</th>
                        <th scope="col">Должность</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
        @endif
                    <tr>
                        <td>
                            {{ $user->full_name }}
                        </td>
                        <td>
                            {{ $user->position->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            <a class="btn btn-secondary" href="{{ route('users.show', $user) }}">
                                Подробнее
                            </a>
                        </td>
                        @if(Auth::user()->is_admin())
                            <form class="ml-auto" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <td>
                                    <a class="btn btn-info" href="{{ route('users.edit', $user->id) }}">
                                        Редактировать
                                    </a>
                                </td>
                                <td>
                                    @if(Auth::user()->id != $user->id)
                                        <button class="btn btn-danger">
                                            Удалить
                                        </button>
                                    @endif
                                </td>
                            </form>
                        @endif
                    </tr>
        @if($loop->last)
                </tbody>
            </table>
        @endif
    @empty
        <div class="alert alert-secondary">
            Пока нет ни одного сотрудника :(
            Но Вы можете это исправить, добавив нового сотрудника :)
        </div>
    @endforelse
@endsection
