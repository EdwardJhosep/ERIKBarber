<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .nav-item.active .nav-link {
            background-color: #007bff26;
            color: white;
        }
        .nav-link {
            color: #007bff26;
        }
        .nav-link:hover {
            color: white;
            background-color: #007bff26;
        }
        .service-photo {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
        @media (max-width: 768px) {
            .service-photo {
                width: 40px;
                height: 40px;
            }
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
                    <a class="nav-link active" href="{{ url('/home') }}"><i class="fas fa-home"></i> Inicio</a>
                </li>
                <li class="nav-item">
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

<div class="container mt-4">
    <h1 class="mb-4">Bienvenido a ERIK Barber-Studio</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Agregar Servicio</h2>
    <form action="{{ url('/save-service') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="serviceName">Nombre del Servicio:</label>
            <input type="text" class="form-control" id="serviceName" name="serviceName" required>
        </div>
        <div class="form-group">
            <label for="price">Precio:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="photo">Seleccionar Foto del Servicio:</label>
            <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*">
        </div>
        <button type="submit" class="btn btn-custom">Agregar Servicio</button>
    </form>

    <h2 class="mt-5">Lista de Servicios</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->price }}</td>
                        <td>{{ $service->description }}</td>
                        <td>
                            @if($service->photo)
                                <img src="{{ asset('storage/' . $service->photo) }}" class="service-photo" alt="Foto del servicio">
                            @else
                                Sin Foto
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="openEditModal({{ $service->id }})"><i class="fas fa-edit"></i> Editar</button>
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para editar servicio -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editServiceForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="editServiceName">Nombre del Servicio:</label>
                        <input type="text" class="form-control" id="editServiceName" name="serviceName" required>
                    </div>

                    <div class="form-group">
                        <label for="editPrice">Precio:</label>
                        <input type="number" class="form-control" id="editPrice" name="price" required>
                    </div>

                    <div class="form-group">
                        <label for="editDescription">Descripción:</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="editPhoto">Seleccionar nueva foto (opcional):</label>
                        <input type="file" class="form-control-file" id="editPhoto" name="photo" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-success">Actualizar Servicio</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function openEditModal(serviceId) {
        // Realizar una llamada AJAX para obtener los datos del servicio
        $.get('/services/' + serviceId + '/edit', function(data) {
            // Rellenar los campos del formulario en el modal
            $('#editServiceName').val(data.name);
            $('#editPrice').val(data.price);
            $('#editDescription').val(data.description);

            // Configurar la acción del formulario para que envíe la solicitud al servicio adecuado
            $('#editServiceForm').attr('action', '/services/' + serviceId);

            // Mostrar el modal
            $('#editModal').modal('show');
        }).fail(function() {
            alert('Error al obtener los datos del servicio.');
        });
    }
</script>

</body>
</html>
