<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servicios</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: rgba(0, 0, 0, 0.6); /* Fondo semitransparente */
            transition: background-color 0.5s ease;
        }
        .navbar.scrolled {
            background-color: rgba(34, 34, 34, 0.9);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .navbar-brand {
            font-weight: bold;
            color: #ffcc00; /* Cambiar a un color destacado */
            font-size: 1.2rem; /* Cambiar este valor para ajustar el tamaño de la fuente */
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.3s;
        }
        .navbar-nav .nav-link {
            color: #f8f9fa;
            padding: 10px 20px;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: color 0.3s, background-color 0.3s;
            border-radius: 5px;
            position: relative;
        }
        .navbar-nav .nav-link:hover {
            background-color: #ffcc00;
            color: #343a40;
        }
        .navbar-toggler {
            border: none;
            background-color: #ffcc00;
            border-radius: 50%;
            outline: none;
            padding: 8px;
        }
        .navbar-toggler:focus {
            box-shadow: none;
        }
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .service-card img {
            object-fit: cover;
            height: 200px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .card-body {
            flex: 1;
            padding: 15px;
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .create-appointment-btn {
            margin-top: 20px;
        }
        .floating-form {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            padding: 20px;
            z-index: 1000;
            display: none; /* Oculto por defecto */
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999; /* Detrás del formulario */
            display: none; /* Oculto por defecto */
        }
        footer {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ERIK Barber-Studio</a>
            <img src="/imagenes/logo.jpg" alt="Logo de ERIK Barber-Studio" width="30" height="30" class="mr-2">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">Inicio</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('servicios') }}">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('acerca') }}">Acerca de</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacto') }}">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<br><br><br>
    <!-- Formulario para consultar citas -->
    <div class="container mt-5">
        <h2 class="text-center">Consultar Citas</h2>
        <form action="{{ route('appointments.consult') }}" method="POST" class="text-center mb-4">
            @csrf
            <div class="form-group">
                <label for="dni">Número de DNI:</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>
            <button type="submit" class="btn btn-primary">Consultar Citas</button>
        </form>
    </div>

    <!-- Mostrar las citas si existen -->
    @if(isset($appointments) && $appointments->isNotEmpty())
        <div class="container">
            <h2 class="text-center">Citas para DNI: {{ request()->dni }}</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Fecha y Hora</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->service->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('d/m/Y H:i') }}</td>
                            <td>{{ $appointment->appointment_type }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        @if(isset($appointments) && $appointments->isEmpty())
            <div class="container">
                <div class="alert alert-warning text-center">No se encontraron citas para el DNI ingresado.</div>
            </div>
        @endif
    @endif

    <div class="container mt-5 pt-5">
        <h1 class="text-center">Servicios</h1>

        <!-- Mensajes de éxito o error -->
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger text-center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Filtro de Servicios -->
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <input type="text" id="serviceFilter" class="form-control" placeholder="Buscar servicio...">
            </div>
        </div>

        <div class="row mt-4" id="serviceList">
            @foreach($services as $service)
                <div class="col-md-4 mb-4">
                    <div class="card service-card">
                        <img src="{{ asset('storage/' . $service->photo) }}" class="card-img-top" alt="{{ $service->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->name }}</h5>
                            <p class="card-text">S/. {{ $service->price }}</p>
                            <p class="card-text">{{ $service->description }}</p>
                            <a href="#" class="btn btn-primary create-appointment-btn" data-service-id="{{ $service->id }}">Crear Cita</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="overlay" id="overlay"></div>
        <div class="floating-form" id="floatingForm">
            <h4 class="text-center">Crear Cita</h4>
            <form id="appointmentForm" method="POST" action="{{ route('appointments.store') }}">
                @csrf
                <div class="form-group">
                    <label for="service">Servicio:</label>
                    <select class="form-control" name="service_id" id="service" required>
                        <option value="">Seleccione un servicio</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="appointment_time">Fecha y Hora:</label>
                    <input type="datetime-local" class="form-control" name="appointment_time" required>
                </div>
                <button type="submit" class="btn btn-success">Crear Cita</button>
                <button type="button" class="btn btn-danger" id="closeForm">Cerrar</button>
            </form>
        </div>
    </div>

    <footer class="text-center mt-5">
        <div class="container">
            <p>&copy; {{ date('Y') }} ERIK Barber-Studio. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Mostrar u ocultar el formulario de creación de cita
            $('.create-appointment-btn').click(function () {
                $('#overlay, #floatingForm').show();
                $('#service').val($(this).data('service-id'));
            });

            $('#closeForm').click(function () {
                $('#overlay, #floatingForm').hide();
            });

            // Filtrar servicios
            $('#serviceFilter').on('keyup', function () {
                var value = $(this).val().toLowerCase();
                $('#serviceList .service-card').filter(function () {
                    $(this).toggle($(this).find('.card-title').text().toLowerCase().indexOf(value) > -1)
                });
            });

            // Ocultar el formulario y el overlay al hacer clic fuera del formulario
            $('#overlay').click(function () {
                $('#overlay, #floatingForm').hide();
            });
        });

        // Cambiar el fondo de la barra de navegación al hacer scroll
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('.navbar').addClass('scrolled');
            } else {
                $('.navbar').removeClass('scrolled');
            }
        });
    </script>
</body>
</html>