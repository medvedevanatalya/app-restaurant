<?php
$update = isset($user);
?>

@extends('layouts.app')

@section('content')

    <?php use App\Models\Position; $positions = Position::all(); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">{{$update ? "Редактировать информацию о сотруднике \"{$user->full_name}\"" : __('Регистрация нового сотрудника') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ $update ? route('users.update', $user) : route('register') }}">
                        @csrf
                        @if($update)
                            @method('PUT')
                        @endif

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Логин:') }}<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="name"
                                       type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       value="{{ old('name') ?? ( $user->name ?? '') }}"
                                       required autocomplete="name"
                                       autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail:') }}<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="email"
                                       type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') ?? ( $user->email ?? '') }}"
                                       required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('ФИО:') }}<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="full_name" type="text"
                                       class="form-control @error('full_name') is-invalid @enderror"
                                       name="full_name"
                                       value="{{ old('full_name') ?? ( $user->full_name ?? '') }}"
                                       required autocomplete="full_name" autofocus>
                                @error('full_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="position_id" class="col-md-4 col-form-label text-md-right">{{ __('Должность') }}<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select name="position_id"
                                        class="form-control @error('position_id') is-invalid @enderror">
                                    <option value="{{ old('position_id') ?? ( $user->position->id ?? '') }}">
                                        {{ old('position_id') ?? ( $user->position->name ?? '-- выберите должность --') }}
                                    </option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                                @error('position_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Адрес:') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text"
                                       class="form-control @error('address') is-invalid @enderror"
                                       name="address" value="{{ old('address') ?? ( $user->address ?? '') }}" autocomplete="address" autofocus>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Телефон:') }}</label>
                            <div class="col-md-6">
                                <input id="phone_number" type="tel"
                                       class="form-control @error('phone_number') is-invalid @enderror"
                                       name="phone_number" value="{{ old('phone_number') ?? ( $user->phone_number ?? '')  }}" autocomplete="phone_number" autofocus>
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if(!$update)
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль:') }}<span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Повторите пароль:') }}<span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if($update)
                                        {{ __('Изменить') }}
                                    @else
                                        {{ __('Регистрация') }}
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
