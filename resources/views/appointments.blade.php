<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver citas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .barber-photo {
            width: 50px; /* Ancho de la foto */
            height: 50px; /* Alto de la foto */
            object-fit: cover; /* Ajustar la imagen sin deformarla */
            border-radius: 50%; /* Hacer la imagen circular */
            cursor: pointer; /* Cambia el cursor al pasar por encima */
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
        /* Asegura que la tabla ocupe el 100% del contenedor */
        .table-responsive {
            overflow-x: auto; /* Permite desplazamiento horizontal */
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

<div class="container mt-4">
    <h2 class="mb-4">Lista de Citas</h2>
    <div class="table-responsive"> <!-- Contenedor responsivo -->
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Número de Celular</th>
                    <th>Fecha de Cita</th>
                    <th>Hora de Cita</th>
                    <th>Tipo de Cita</th>
                    <th>Estado</th>
                    <th>Foto de Pago</th>
                    <th>Acciones</th> <!-- Nueva columna para acciones -->
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->phone_number }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->appointment_time }}</td>
                    <td>{{ $appointment->appointment_type }}</td>
                    <td>{{ $appointment->status }}</td>
                    <td>
                        @if($appointment->fotopagocita)
                            <img src="{{ asset('storage/' . $appointment->fotopagocita) }}" class="barber-photo" alt="Foto de pago" data-toggle="modal" data-target="#photoModal" data-img="{{ asset('storage/' . $appointment->fotopagocita) }}">
                        @else
                            Sin foto
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('appointments.confirm', $appointment->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-custom">Confirmar Cita</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para mostrar la foto de pago -->
<div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="photoModalLabel">Foto de Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Foto de pago" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // JavaScript para cambiar la imagen del modal al hacer clic en la foto
    $(document).on('click', '.barber-photo', function() {
        var imgSrc = $(this).data('img');
        $('#modalImage').attr('src', imgSrc);
    });
</script>

</body>
</html>
