@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Perfil') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('perfil.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text"
                                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        placeholder="{{ old('nombre', Auth::user()->nombre ?? '') }}" autocomplete="nombre">

                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="apellido"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Apellido') }}</label>

                                <div class="col-md-6">
                                    <input id="apellido" type="text"
                                        class="form-control @error('apellidos') is-invalid @enderror" name="apellidos"
                                        placeholder="{{ old('apellidos', Auth::user()->apellidos ?? '') }}" autocomplete="apellido">

                                    @error('apellidos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="fecha_nacimiento"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Fecha de nacimiento') }}</label>

                                <div class="col-md-6">
                                    <input id="fecha_nacimiento" type="date"
                                        class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                        name="fecha_nacimiento" value="{{ old('fecha_nacimiento', Auth::user()->fecha_nacimiento ?? '') }}"
                                        autocomplete="fecha_nacimiento">

                                    @error('fecha_nacimiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Correo electrónico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', Auth::user()->email ?? '') }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="peso_base"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Peso (kg)') }}</label>

                                <div class="col-md-6">
                                    <input id="peso_base" type="number" step="0.1"
                                        class="form-control @error('peso_base') is-invalid @enderror" name="peso_base"
                                        value="{{ old('peso_base', Auth::user()->peso_base ?? '') }}" autocomplete="peso_base">

                                    @error('peso_base')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="altura_base"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Altura (cm)') }}</label>

                                <div class="col-md-6">
                                    <input id="altura_base" type="number"
                                        class="form-control @error('altura_base') is-invalid @enderror" name="altura_base"
                                        value="{{ old('altura_base', Auth::user()->altura_base ?? '') }}" autocomplete="altura_base">

                                    @error('altura_base')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Nueva contraseña (opcional)') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirmar contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar perfil') }}
                                    </button>
                                    <a href="{{ route('perfil') }}" class="btn btn-secondary">
                                        {{ __('Cancelar') }}
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection