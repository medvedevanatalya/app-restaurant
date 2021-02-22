<?php
$update = isset($client);
?>
@extends('layouts.app')
@section('header')
    <h2 class="mb-3">
        {{ $update ? "Редактировать информацию о клиенте \"{$client->full_name}\"" : 'Новый клиент'}}
    </h2>
@endsection
@section('content')
    <div class="card card-body">
        <form action="{{ $update ? route('clients.update', $client) : route('clients.store') }}" method="POST">
            @csrf
            @if($update)
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="full_name">ФИО<span class="text-danger">*</span></label>
                <input class="form-control @error('full_name') is-invalid @enderror"
                       type="text"
                       name="full_name"
                       id="full_name"
                       placeholder="Введите ФИО..."
                       value="{{ old('full_name') ?? ( $client->full_name ?? '') }}">
                @error('full_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone_number">Номер телефона</label>
                <input class="form-control @error('phone_number') is-invalid @enderror"
                       type="tel"
                       name="phone_number"
                       id="phone_number"
                       placeholder="Введите номер телефона..."
                       value="{{ old('phone_number') ?? ( $client->phone_number ?? '') }}">
                @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button class="btn btn-success">
                {{ $update ? 'Обновить' : 'Добавить' }}
            </button>
        </form>
    </div>
@endsection
