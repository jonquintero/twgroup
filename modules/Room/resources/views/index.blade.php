@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">{{ __('Gestión de Salas') }}</h2>
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
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Búsqueda y botón para crear nueva sala -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar salas..." aria-label="Buscar" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-8 text-end">
                        <a href="{{ route('rooms.create') }}" class="btn btn-dark">
                            <i class="bi bi-plus-lg me-1"></i>{{ __('Crear Sala') }}
                        </a>
                    </div>
                </div>

                <!-- Tabla de Salas -->
                @if ($rooms->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        {{ __('No hay salas disponibles.') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('Nombre') }}</th>
                                <th>{{ __('Descripción') }}</th>
                                <th class="text-end">{{ __('Acciones') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->description }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('rooms.edit', $room) }}" class="btn btn-outline-secondary btn-sm me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta sala?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Enlaces de paginación -->
                    <div class="mt-4">
                        {{ $rooms->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
