@extends('layouts.app')

@section('header')
    <h3>Клиенты
        <div class="mt-2">
            <a href="{{ route('clients.create') }}" class="ml-auto btn btn-success"> Добавить клиента </a>
        </div>
    </h3>
@endsection

@section('content')

    @forelse($clients as $client)
        @if($loop->first)
            <table class="table table-bordered table-striped">
                <thead class="thead-inverse">
                <tr>
                    <th>#</th>
                    <th scope="col">ФИО</th>
                    <th scope="col">Номер телефона</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @endif
                <tr>
                    <th scope="row"></th>
                    <td>
                        {{ $client->full_name }}
                    </td>
                    <td>
                        {{ $client->phone_number }}
                    </td>
                    @if(Auth::user()->is_admin())
                        <form class="ml-auto" action="{{ route('clients.destroy', $client) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('update', $client)
                                <td>
                                    <a class="btn btn-info" href="{{ route('clients.edit', $client) }}">
                                        Редактировать
                                    </a>
                                </td>
                            @endcan
                            @can('delete', $client)
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
            Пока нет ни одного клиента :(
            Но Вы можете это исправить, добавив нового клиента :)
        </div>
    @endforelse
@endsection
