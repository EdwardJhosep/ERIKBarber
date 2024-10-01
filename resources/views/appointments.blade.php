<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver Citas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .btn-logout {
            background-color: #dc3545; /* Color rojo para el botón de cerrar sesión */
            color: white;
        }
        .btn-logout:hover {
            background-color: #c82333; /* Color más oscuro al pasar el mouse */
        }
        .table img {
            width: 50px;
            height: 50px;
            object-fit: cover; /* Mantiene la proporción de la imagen */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">ERIK Barber-Studio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/home') }}"><i class="fas fa-home"></i> Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/add-barber') }}"><i class="fas fa-user-plus"></i> Agregar Barbero</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/appointments') }}"><i class="fas fa-calendar-check"></i> Ver Citas</a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-logout" style="cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h1>Ver Citas</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>Servicio</th>
                    <th>Precio</th>
                    <th>Foto</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $appointment->dni }}</td>
                        <td>{{ $appointment->service->name }}</td>
                        <td>{{ $appointment->service->price }}</td>
                        <td>
                            @if($appointment->service->photo)
                                <img src="{{ asset('storage/' . $appointment->service->photo) }}" alt="{{ $appointment->service->name }}">
                            @else
                                Sin foto
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i A') }}</td>
                        <td>
                            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success" onclick="return confirm('¿Estás seguro de que deseas marcar esta cita como terminada?')">Terminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($appointments->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">No hay citas disponibles.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
