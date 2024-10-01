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
            font-size: 1.8rem;
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
                            <!-- Botón para crear cita específico para cada servicio -->
                            <button class="btn btn-primary create-appointment-btn" onclick="openForm('{{ $service->id }}')">Crear Cita</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Formulario flotante -->
    <div class="overlay" id="overlay"></div>
    <div class="floating-form" id="floatingForm">
        <h2 class="text-center">Crear Cita</h2>
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <input type="hidden" id="service_id" name="service_id">
            <div class="form-group">
                <label for="dni">Número de DNI:</label>
                <input type="text" class="form-control" id="dni" name="dni" required>
            </div>

            <div class="form-group">
                <label for="appointment_date">Selecciona una fecha:</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" required min="{{ date('Y-m-d') }}">
            </div>

            <div class="form-group">
                <label for="appointment_time">Selecciona una hora:</label>
                <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
            </div>

            <button type="submit" class="btn btn-success">Confirmar Cita</button>
            <button type="button" class="btn btn-danger" onclick="closeForm()">Cancelar</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 mt-5">
        <div class="container">
            <p>© 2024 ERIK Barber-Studio. Todos los derechos reservados.</p>
            <p>
                <a href="https://www.facebook.com/erikbarberstudio" class="text-white"><i class="fab fa-facebook"></i> Facebook</a> | 
                <a href="#" class="text-white"><i class="fab fa-instagram"></i> Instagram</a>
            </p>
            <p>Dirección: Av. Girasoles 848, Amarilis 10003 | Teléfono: (123) 456-7890</p>
        </div>
    </footer>

    <script>
        // Funciones para mostrar y ocultar el formulario
        function openForm(serviceId) {
            document.getElementById('service_id').value = serviceId;
            document.getElementById('floatingForm').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closeForm() {
            document.getElementById('floatingForm').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        // Filtro de servicios
        document.getElementById('serviceFilter').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const services = document.querySelectorAll('#serviceList .card');
            services.forEach(service => {
                const title = service.querySelector('.card-title').textContent.toLowerCase();
                service.style.display = title.includes(filter) ? '' : 'none';
            });
        });

        // Establecer la fecha mínima al cargar la página
        window.onload = function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('appointment_date').setAttribute('min', today);
        };
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
