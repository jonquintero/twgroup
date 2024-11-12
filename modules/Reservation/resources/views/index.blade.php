
@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">{{ __('Mis Reservaciones') }}</h2>
        <div class="card shadow-sm">
            <div class="card-header">&nbsp;</div>
            <div class="card-body">
               <!-- Mensajes de éxito -->
                @if(session('success'))
                    <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        <p>{{ session('success') }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Búsqueda y botón para crear nueva reservación -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar reservaciones..." aria-label="Buscar" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-8 text-end">
                        <a href="{{ route('reservations.create') }}" class="btn btn-dark">
                            <i class="bi bi-plus-lg me-1"></i>{{ __('Crear Reservación') }}
                        </a>
                    </div>
                </div>

                <!-- Tabla de Reservaciones -->
                @if ($reservations->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        {{ __('No hay reservaciones disponibles.') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('Sala') }}</th>
                                <th>{{ __('Fecha de Reservación') }}</th>
                                <th>{{ __('Estado') }}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->room->name }}</td>
                                    <td>{{ Carbon::parse($reservation->reservation_date)->format('d/m/Y h:i A') }}</td>
                                    <td>
                                        @if($reservation->status == 'Pending')
                                            <span class="badge bg-warning text-dark">{{ ucfirst($reservation->status) }}</span>
                                        @elseif($reservation->status == 'Accepted')
                                            <span class="badge bg-success">{{ ucfirst($reservation->status) }}</span>
                                        @elseif($reservation->status == 'Rejected')
                                            <span class="badge bg-danger">{{ ucfirst($reservation->status) }}</span>
                                        @else
                                            {{ ucfirst($reservation->status) }}
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Enlaces de paginación -->
                    <div class="mt-4">
                        {{ $reservations->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
