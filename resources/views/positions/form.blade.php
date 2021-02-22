<?php
$update = isset($position);
?>

@extends('layouts.app')

@section('header')
    <h2 class="mb-3">{{ $update ? "Редактировать должность \"{$position->name}\"" : 'Новая должность'}}</h2>
@endsection

@section('content')
    <div class="card card-body">

        <form action="{{ $update ? route('positions.update', $position) : route('positions.store') }}" method="POST">
            @csrf
            @if($update)
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Должность<span class="text-danger">*</span></label>
                <input class="form-control @error('name') is-invalid @enderror"
                       type="text"
                       name="name"
                       id="name"
                       placeholder="Введите должность..."
                       value="{{ old('name') ?? ( $position->name ?? '') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="salary">Оклад<span class="text-danger">*</span></label>
                <input class="form-control @error('salary') is-invalid @enderror"
                       type="number"
                       name="salary"
                       id="salary"
                       placeholder="Введите оклад..."
                       value="{{ old('salary') ?? ( $position->salary ?? '') }}">
                @error('salary')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success">
                {{ $update ? 'Обновить' : 'Добавить' }}
            </button>

        </form>
    </div>
@endsection
