<?php
$update = isset($order);
?>

@extends('layouts.app')

@section('header')
    <h2 class="mb-3">
        {{ $update ? "Редактировать информацио о заказе №{$order->id}" : 'Новый заказ'}}
    </h2>
@endsection

@section('content')

    <div class="card card-body">

        <form action="{{ $update ? route('orders.update', $order) : route('orders.store') }}" method="POST">
            @csrf
            @if($update)
                @method('PUT')
            @endif

            <div class="form-group row">
                <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('Сотрудник') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <select name="user_id"
                            class="form-control @error('user_id') is-invalid @enderror">
                        <option value="{{ old('user_id') ?? ( $order->user->id ?? '') }}">
                            {{ old('user_id') ?? ( $order->user->full_name ?? '-- выберите сотрудника --') }}
                        </option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="client_id" class="col-md-4 col-form-label text-md-right">{{ __('Клиент') }}<span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <select name="client_id"
                            class="form-control @error('client_id') is-invalid @enderror">
                        <option value="{{ old('client_id') ?? ( $order->client->id ?? '') }}">
                            {{ old('client_id') ?? ( $order->client->full_name ?? '-- выберите клиента --') }}
                        </option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->full_name }}</option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            @if($update)
                <div class="form-group custom-control custom-checkbox">
                    <input type="hidden" name="status" value="0">
                    <input value="1"
                           type="checkbox"
                           class="custom-control-input"
                           name="status"
                           id="status"
                           @if((old('status') ?? ($order->status ?? false)) == '1') checked @endif>
                    <label for="status" class="custom-control-label">Выполнен заказ?</label>
                </div>
            @endif

            <div class="form-group">
                <label for="dishes[]">{{ __('Блюда') }}<span class="text-danger">*</span></label><br>
                <div class="row ml-2">
                    @foreach($dishes as $dish)
                        <div class="form-check col-6 col-sm-3">
                            @if($update)
                                <input class="form-check-input" id={{ "idCheckBox{$dish->id}" }} type="checkbox" name="dishes[]" value="{{ $dish->id }}"
                                       @if($order->dishes->where('id', $dish->id)->count())
                                       checked="checked"
                                    @endif>
                                <label class="form-check-label mr-3" for={{ "idCheckBox{$dish->id}" }}>{{ $dish->name }}</label>
                            @else
                                <input class="form-check-input" id={{ "idCheckBox{$dish->id}" }} type="checkbox" name="dishes[]" value="{{ $dish->id }}">
                                <label class="form-check-label mr-3" for={{ "idCheckBox{$dish->id}" }}>{{ $dish->name }}</label>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <button class="btn btn-success">
                {{ $update ? 'Обновить' : 'Добавить' }}
            </button>

        </form>
    </div>
@endsection
