@extends('layouts.app')

@section('header')
    <h1>
        Полная информация о заказе №{{ $order->id }}
    </h1>
@endsection

@section('content')

    <div>
        <ul class="list-group">
            <li class="list-group-item">
                <form class="ml-auto" action="{{ route('orders.destroy', $order) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    @can('update', $order)
                        <a href="{{ route('orders.toggle', $order) }}" class="btn {{ $order->status ? 'btn-success' : 'btn-secondary' }}">
                            {{ Str::of(($order->status ? '' : 'не ') .'выполнен')->lower()->ucfirst() }}
                        </a>

                        <a class="btn btn-info" href="{{ route('orders.edit', $order) }}">
                            Редактировать
                        </a>
                    @endcan
                    @can('delete', $order)
                        <button class="btn btn-danger">
                            Удалить
                        </button>
                    @endcan
                </form>
            </li>

            <li class="list-group-item">
                Дата заказа: {{ $order->date }}
            </li>

            <li class="list-group-item panel-body">
                <table class="table-padding">
                    <style>
                        .table-padding td{
                            padding: 3px 8px;
                        }
                    </style>

                    <tr>
                        <td>Клиент: </td>
                        <td>{{ $order->client->full_name }}</td>
                    </tr>
                    <tr>
                        <td>Сотрудник: </td>
                        <td>{{ $order->user->full_name }}</td>
                    </tr>
                    <tr>
                        <td>Статус: </td>
                        <td>
                            @if($order->status == true)
                                Выполнен
                            @else
                                Не выполнен
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Блюда: </td>
                        <td>
                            {{ $order->dishes()->pluck('name')->implode(', ') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Сумма заказа: </td>
                        <td>{{ $amount_order }}</td>
                    </tr>
                </table>
            </li>

        </ul>
    </div>
    <hr>

@endsection
