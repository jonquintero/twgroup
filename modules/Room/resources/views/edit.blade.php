@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Editar Sala</h2>

        <div class="card shadow-sm">
            <div class="card-header">&nbsp;</div>
            <div class="card-body">
                <form action="{{ route('rooms.update', $room) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Campo de Nombre -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre de la Sala</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $room->name) }}" required>
                        @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de Descripción -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description', $room->description) }}</textarea>
                        @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botones de Guardar y Cancelar -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
