<?php
$update = isset($table);
?>

@extends('layouts.app')

@section('header')
    <h2 class="mb-3">{{ $update ? "Редактировать информацио о столике \"{$table->name}\"" : 'Новый столик'}}</h2>
@endsection

@section('content')
    <div class="card card-body">

        <form action="{{ $update ? route('tables.update', $table) : route('tables.store') }}" method="POST">
            @csrf
            @if($update)
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Название<span class="text-danger">*</span></label>
                <input class="form-control @error('name') is-invalid @enderror"
                       type="text"
                       name="name"
                       id="name"
                       placeholder="Введите название..."
                       value="{{ old('name') ?? ( $table->name ?? '') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success">
                {{ $update ? 'Обновить' : 'Добавить' }}
            </button>

        </form>
    </div>
@endsection
