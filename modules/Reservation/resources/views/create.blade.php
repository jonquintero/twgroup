@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">{{ __('Crear Reservación') }}</h2>

        <div class="card shadow-sm">
            <div class="card-header">{{ __('Complete el formulario') }}</div>
            <div class="card-body">
                <form method="post" action="{{ route('reservations.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <!-- Campo para seleccionar la sala -->
                        <div class="col-md-6">
                            <label for="room_id" class="form-label">{{ __('Sala') }}</label>
                            <select name="room_id" id="room_id" class="form-select" required>
                                <option value="">Seleccione una sala</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo para la fecha y hora de la reservación -->
                        <div class="col-md-6">
                            <label for="reservation_date" class="form-label">{{ __('Fecha y Hora') }}</label>
                            <input type="datetime-local" id="reservation_date" name="reservation_date" class="form-control" value="{{ old('reservation_date') }}" required>
                            @error('reservation_date')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <!-- Botón de cancelar -->
                        <a href="{{ route('reservations.index') }}" class="btn btn-danger">
                            {{ __('Cancelar') }}
                        </a>

                        <!-- Botón de guardar -->
                        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
