<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Barbero</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .barber-photo {
            width: 50px; /* Ancho de la foto */
            height: 50px; /* Alto de la foto */
            object-fit: cover; /* Ajustar la imagen sin deformarla */
            border-radius: 50%; /* Hacer la imagen circular */
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .btn-logout {
            background-color: #dc3545; /* Color rojo para el botón de cerrar sesión */
            color: white;
        }
        .btn-logout:hover {
            background-color: #c82333; /* Color más oscuro al pasar el mouse */
        }
        .logout-container {
            display: inline-block;
            margin-left: 20px;
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
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/add-barber') }}"><i class="fas fa-user-plus"></i> Agregar Barbero</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/appointments') }}"><i class="fas fa-calendar-check"></i> Ver Citas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/confirmed-appointments') }}"><i class="fas fa-check-circle"></i> Ver Citas Confirmadas</a>
            </li>
            <li class="nav-item logout-container">
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

<div class="container mt-5">
    <h2>Agregar Nuevo Barbero</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('barbers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nombre del Barbero</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre del barbero" required>
        </div>
        <div class="form-group">
            <label for="specialty">Especialidad</label>
            <input type="text" class="form-control" name="specialty" id="specialty" placeholder="Especialidad" required>
        </div>
        <div class="form-group">
            <label for="photo">Foto</label>
            <input type="file" class="form-control-file" name="photo" id="photo">
        </div>
        <button type="submit" class="btn btn-custom">Agregar Barbero</button>
    </form>

    <h2 class="mt-5">Lista de Barberos</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Foto</th> <!-- Nueva columna para la foto -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barbers as $barber)
                    <tr>
                        <td>{{ $barber->id }}</td>
                        <td>{{ $barber->name }}</td>
                        <td>{{ $barber->specialty }}</td>
                        <td>
                            @if($barber->photo)
                                <img src="{{ asset('storage/' . $barber->photo) }}" alt="{{ $barber->name }}" class="barber-photo">
                            @else
                                Sin foto
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('barbers.destroy', $barber->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
