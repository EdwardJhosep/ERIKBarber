<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Citas para {{ \Carbon\Carbon::today()->addDay()->format('d-m-Y') }}</h1>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('appointments.create.blank') }}" method="POST" class="mb-4">
            @csrf
            <button type="submit" class="btn btn-primary">Crear Citas en Blanco</button>
        </form>

        <form action="{{ route('appointments.next.day') }}" method="GET" class="mb-4">
            <button type="submit" class="btn btn-secondary">Ver Siguiente Día</button>
        </form>
        
        @if ($appointments->isEmpty())
            <div class="alert alert-warning" role="alert">
                No hay citas disponibles.
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Hora de Cita</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}</td>
                            <td>{{ $appointment->appointment_time }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $appointment->id }}">
                                    Editar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal de Edición -->
                        <div class="modal fade" id="editModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $appointment->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $appointment->id }}">Editar Cita</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            
                                            <div class="mb-3">
                                                <label for="phone_number" class="form-label">Número de Teléfono</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $appointment->phone_number }}" required>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="fotopagocita" class="form-label">Foto de Pago</label>
                                                <input type="file" class="form-control" id="fotopagocita" name="fotopagocita" accept="image/*">
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Actualizar Cita</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
</body>
</html>
