@extends('layouts.user_type.auth')

@section('content')
    <h1 class="text-left font-semibold text-sm">Formulario de subcategoría</h1>

    <div class="rounded-3xl border-cyan-500">
        {{-- Formulario para registrar una subcategoría --}}
        <form action="{{ route('registrar-subcategoria-store') }}" method="POST" novalidate>
            @csrf

            {{-- Selección de la categoría padre --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="categoria_subcategoria">Seleccione una categoría</label>
                    {{-- Select --}}
                    <select class="form-control" id="categoria_subcategoria" name="categoria_subcategoria">
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                        @endforeach
                    </select>

                    {{-- Mensaje de error --}}
                    @error('categoria_subcategoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Código de la subcategoría --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="codigo_subcategoria">Código de Subcategoría</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Código de Subcategoría" class="form-control" id="codigo_subcategoria"
                        name="codigo_subcategoria" value="{{ old('codigo_subcategoria') }}" />

                    {{-- Mensaje de error --}}
                    @error('codigo_subcategoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Nombre de la subcategoría --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="nombre_subcategoria">Nombre de Subcategoría</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Nombre de Subcategoría" class="form-control" id="nombre_subcategoria"
                        name="nombre_subcategoria" value="{{ old('nombre_subcategoria') }}" />

                    {{-- Mensaje de error --}}
                    @error('nombre_subcategoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Descripción de la subcategoría --}}
            <div class="col-md-6">
                <div class="form-group">
                    {{-- Label --}}
                    <label for="descripcion_subcategoria">Descripción de Subcategoría</label>
                    {{-- Input --}}
                    <input type="text" placeholder="Descripción de Subcategoría" class="form-control"
                        id="descripcion_subcategoria" name="descripcion_subcategoria"
                        value="{{ old('descripcion_subcategoria') }}" />

                    {{-- Mensaje de error --}}
                    @error('descripcion_subcategoria')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Campo oculto para saber quién la creó --}}
            <input type="hidden" id="subcategoria_creada_por" name="subcategoria_creada_por"
                value="{{ auth()->user()->name }}">

            {{-- Boton para enviar el registro de subcategoría --}}
            <button class="btn bg-gradient-success" type="submit" value="Registrar Subcategoría">
                Enviar
            </button>
        </form>
    </div>

    {{-- Alerta de éxito --}}
    @if (session('mensaje'))
        <div class="alert alert-success" role="alert">
            <strong>Success!</strong> {{ session('mensaje') }}
        </div>
    @endif
@endsection