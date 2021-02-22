<?php
$update = isset($dish);
?>

@extends('layouts.app')

@section('header')
    <h2 class="mb-3">
        {{ $update ? "Редактировать информацио о блюде \"{$dish->name}\"" : 'Новое блюдо'}}
    </h2>
@endsection

@section('content')

    <div class="card card-body">

        <form action="{{ $update ? route('dishes.update', $dish) : route('dishes.store') }}" method="POST">
{{--            <form action="{{ route('dishes.store') }}" method="POST">--}}
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
                       value="{{ old('name') ?? ( $dish->name ?? '') }}">
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
                       value="{{ old('price') ?? ( $dish->price ?? '') }}">
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ingredients[]">{{ __('Ингредиенты') }}<span class="text-danger">*</span></label><br>
                <div class="row ml-2">
                    @foreach($ingredients as $ingredient)
                        <div class="form-check col-6 col-sm-3">
                            @if($update)
                            <input class="form-check-input" id={{ "idCheckBox{$ingredient->id}" }} type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}"
                                   @if($dish->ingredients->where('id', $ingredient->id)->count())
                                        checked="checked"
                                   @endif>
                            <label class="form-check-label mr-3" for={{ "idCheckBox{$ingredient->id}" }}>{{ $ingredient->name }}</label>
                            @else
                                <input class="form-check-input" id={{ "idCheckBox{$ingredient->id}" }} type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}">
                                <label class="form-check-label mr-3" for={{ "idCheckBox{$ingredient->id}" }}>{{ $ingredient->name }}</label>
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
