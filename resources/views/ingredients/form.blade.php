<?php
$update = isset($ingredient);
?>

@extends('layouts.app')

@section('header')
    <h2 class="mb-3">{{ $update ? "Редактировать информацио о ингредиенте \"{$ingredient->name}\"" : 'Новый ингредиент'}}</h2>
@endsection

@section('content')
    <div class="card card-body">

        <form action="{{ $update ? route('ingredients.update', $ingredient) : route('ingredients.store') }}" method="POST">
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
                       value="{{ old('name') ?? ( $ingredient->name ?? '') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Цена<span class="text-danger">*</span></label>
                <input class="form-control @error('price') is-invalid @enderror"
                       type="number"
                       name="price"
                       id="price"
                       placeholder="Введите цену..."
                       value="{{ old('price') ?? ( $ingredient->price ?? '') }}">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="available_quantity">Доступное количество<span class="text-danger">*</span></label>
                <input class="form-control @error('available_quantity') is-invalid @enderror"
                       type="number"
                       name="available_quantity"
                       id="available_quantity"
                       placeholder="Введите количество..."
                       value="{{ old('available_quantity') ?? ( $ingredient->available_quantity ?? '') }}">
                @error('available_quantity')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success">
                {{ $update ? 'Обновить' : 'Добавить' }}
            </button>

        </form>
    </div>
@endsection
