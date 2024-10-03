<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver y Crear Citas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Crear Cita</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="phone_number">Número de Celular:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="appointment_date">Fecha de la Cita:</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
            </div>
            <div class="form-group">
                <label for="appointment_time">Hora de la Cita:</label>
                <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
            </div>
            <div class="form-group">
                <label for="appointment_type">Tipo de Cita:</label>
                <input type="text" class="form-control" id="appointment_type" name="appointment_type" required>
            </div>
            <div class="form-group">
                <label for="fotopagocita">Foto del Pago (opcional):</label>
                <input type="file" class="form-control" id="fotopagocita" name="fotopagocita" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Crear Cita</button>
        </form>

        <hr>

        <h2 class="mt-5">Listado de Citas</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Número de Celular</th>
                    <th>Fecha de la Cita</th>
                    <th>Hora de la Cita</th>
                    <th>Tipo de Cita</th>
                    <th>Estado</th>
                    <th>Foto de Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->id }}</td>
                        <td>{{ $appointment->phone_number }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</td>
                        <td>{{ $appointment->appointment_time }}</td>
                        <td>{{ $appointment->appointment_type }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                        <td>
                            @if($appointment->fotopagocita)
                                <a href="{{ asset('storage/' . $appointment->fotopagocita) }}" target="_blank">Ver Foto</a>
                            @else
                                Sin foto
                            @endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">Editar</a>
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
