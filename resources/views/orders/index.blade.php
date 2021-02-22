@extends('layouts.app')

@section('header')
    <h3>Заказы
        <div class="mt-2">
            <a href="{{ route('orders.create') }}" class="ml-auto btn btn-success">
                Добавить заказ
            </a>
        </div>
    </h3>
@endsection

@section('content')

    @forelse($orders as $order)
        @if($loop->first)
            <table class="table table-bordered table-striped">
                <thead class="thead-inverse">
                <tr>
                    <th scope="col">Номер заказа</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Дата заказа</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @endif
                <tr>
                    <td>
                        {{ $order->id }}
                    </td>
                    <td>
                        @if($order->isCompleted())
                            <span class="badge badge-success">
                                Выполнен
                            </span>
                        @else
                            <span class="badge badge-danger">
                                Не выполнен
                            </span>
                        @endif
                    </td>
                    <td>
                        {{ $order->date }}
                    </td>
                    <td>
                        <a class="btn btn-secondary" href="{{ route('orders.show', $order) }}">
                            Подробнее
                        </a>
                    </td>
                        <form class="ml-auto" action="{{ route('orders.destroy', $order) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('update', $order)
                                <td>
                                    <a class="btn btn-info" href="{{ route('orders.edit', $order) }}">
                                        Редактировать
                                    </a>
                                </td>
                            @endcan
                            @can('delete', $order)
                                <td>
                                    <button class="btn btn-danger">
                                        Удалить
                                    </button>
                                </td>
                            @endcan
                        </form>
                </tr>
                @if($loop->last)
                </tbody>
            </table>
        @endif

    @empty
        <div class="alert alert-secondary">
            Пока нет ни одного заказа :(
            Но Вы можете это исправить, добавив новый заказ :)
        </div>
    @endforelse
@endsection
