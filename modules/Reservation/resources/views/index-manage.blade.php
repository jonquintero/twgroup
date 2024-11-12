@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">{{ __('Gestión de Reservas') }}</h2>

        <div class="card shadow-sm">
            <div class="card-header">&nbsp;</div>
            <div class="card-body">
                @if(session('success'))
                    <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        <p>{{ session('success') }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- Filtro por Sala -->
                <form method="GET" action="{{ route('admin.reservations.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="room_id" class="form-select" onchange="this.form.submit()">
                                <option value="">{{ __('Todas las Salas') }}</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                <!-- Tabla de Reservas -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>{{ __('Sala') }}</th>
                            <th>{{ __('Fecha de Reservación') }}</th>
                            <th>{{ __('Cliente') }}</th>
                            <th>{{ __('Estado') }}</th>
                            <th class="text-end">{{ __('Acciones') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->room->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y h:i A') }}</td>
                                <td>{{ $reservation->user->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $reservation->status === 'Pending' ? 'warning' : ($reservation->status === 'Accepted' ? 'success' : 'danger') }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>

                                <td class="text-end">
                                    <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="Accepted">
                                        <button type="submit" class="btn btn-outline-success btn-sm" {{ $reservation->status === 'Accepted' ? 'disabled' : '' }}>
                                            {{ __('Aceptar') }}
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="Rejected">
                                        <button type="submit" class="btn btn-outline-danger btn-sm" {{ $reservation->status === 'Rejected' ? 'disabled' : '' }}>
                                            {{ __('Rechazar') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-3">
                    {{ $reservations->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
