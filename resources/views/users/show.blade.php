@extends('layouts.app')

@section('header')
    <h1>
        Полная информация о сотруднике {{ $user->full_name }}
    </h1>
@endsection

@section('content')

    <div>
        <ul class="list-group">
            <li class="list-group-item">
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
            </li>
            <li class="list-group-item">
                Сотрудник добавлен {{ $user->created_at->format('M d, Y a\t h:i a') }}
            </li>

            <li class="list-group-item panel-body">
                <table class="table-padding">
                    <style>
                        .table-padding td{
                            padding: 3px 8px;
                        }
                    </style>

                    <tr>
                        <td>Логин в системе: </td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>ФИО: </td>
                        <td>{{ $user->full_name }}</td>
                    </tr>
                    <tr>
                        <td>Должность: </td>
                        <td>{{ $user->position->name }}</td>
                    </tr>
                    <tr>
                        <td>Оклад: </td>
                        <td>{{ $user->position->salary }}</td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Телефон: </td>
                        @if($user->phone_number == null)
                            <td>Не заполнено</td>
                        @else
                            <td>{{ $user->phone_number }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Адрес: </td>
                        @if($user->address == null)
                            <td>Не заполнено</td>
                        @else
                            <td>{{ $user->address }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Количество заказов: </td>
                        <td>{{ $ordersCount }}</td>
                    </tr>
                    <tr>
                        <td>Количество выполненных заказов: </td>
                        <td>{{ $ordersCountDone }}</td>
                    </tr>
                    <tr>
                        <td>Количество не выполненных заказов: </td>
                        <td>{{ $ordersCountNotDone }}</td>
                    </tr>

                </table>
            </li>

        </ul>
    </div>
    <hr>

@endsection
