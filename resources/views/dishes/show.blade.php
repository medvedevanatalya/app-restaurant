@extends('layouts.app')

@section('header')
    <h1>
        Полная информация о блюде {{ $dish->name }}
    </h1>
@endsection

@section('content')

    <div>
        <ul class="list-group">
            <li class="list-group-item">
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
            </li>

            <li class="list-group-item">
                Блюдо добавлено в меню {{ $dish->created_at->format('M d, Y a\t h:i a') }}
            </li>

            <li class="list-group-item panel-body">
                <table class="table-padding">
                    <style>
                        .table-padding td{
                            padding: 3px 8px;
                        }
                    </style>

                    <tr>
                        <td>Название: </td>
                        <td>{{ $dish->name }}</td>
                    </tr>
                    <tr>
                        <td>Цена: </td>
                        <td>{{ $dish->price }}</td>
                    </tr>
                    <tr>
                        <td>Ингредиенты: </td>
                        <td>{{ $dish->ingredients()->pluck('name')->implode(', ') }}</td>
                    </tr>


{{--                    <tr>--}}
{{--                        <td>Количество заказов: </td>--}}
{{--                        <td>{{ $ordersCount }}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Количество выполненных заказов: </td>--}}
{{--                        <td>{{ $ordersCountDone }}</td>--}}
{{--                    </tr>--}}

                </table>
            </li>

        </ul>
    </div>
    <hr>

@endsection
