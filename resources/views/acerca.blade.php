<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acerca de Nosotros</title>
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

        .team-card {
            max-width: 300px; /* Establece un tamaño máximo para las tarjetas */
            margin: 15px; /* Espaciado entre tarjetas */
            flex: 1; /* Las tarjetas ocupan el mismo espacio */
            min-width: 280px; /* Asegura que las tarjetas no se hagan demasiado pequeñas */
            height: 400px; /* Asegura que todas las tarjetas tengan la misma altura */
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Asegura que el contenido esté bien distribuido */
        }

        .card-img-top {
            width: 100%; /* Asegura que la imagen ocupe todo el ancho del contenedor */
            height: 200px; /* Ajusta el alto de la imagen */
            object-fit: cover; /* Mantiene la proporción de la imagen */
        }

        .card {
            border: none;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra predeterminada */
            height: 100%; /* Asegura que todas las tarjetas tengan la misma altura */
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-10px); /* Mover ligeramente hacia arriba al pasar el mouse */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); /* Sombra más fuerte al pasar el mouse */
        }

        .card-body {
            flex-grow: 1; /* Hace que el cuerpo ocupe todo el espacio disponible */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: bold;
            text-align: center;
        }

        .card-text {
            text-align: center;
            font-size: 1rem;
            color: #6c757d;
        }

        .team-section {
            display: flex;
            justify-content: center; /* Centra las tarjetas horizontalmente */
            flex-wrap: wrap; /* Permite que las tarjetas se ajusten en filas */
        }

        .icon-links i {
            font-size: 1.5rem;
            color: #ffcc00;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .icon-links i:hover {
            color: #f8f9fa;
        }

        footer {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('servicios') }}">Servicios</a>
                    </li>
                    <li class="nav-item active">
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
        <h1 class="text-center">Acerca de Nosotros</h1>
        <p class="text-center">En ERIK Barber-Studio, contamos con un equipo de barberos profesionales apasionados por el estilo. Nuestra misión es ofrecerte una experiencia única y personalizada en cada visita.</p>
        <p class="text-center">Creemos que cada corte de cabello es una forma de arte, y estamos dedicados a ayudarte a encontrar tu estilo perfecto.</p>
        
        <h2 class="text-center mt-5">Nuestro Equipo de Barberos</h2>
        <div class="team-section mt-4">
            @foreach($barbers as $barber)
                <div class="team-card">
                    <div class="card">
                        <img src="{{ asset('storage/' . $barber->photo) }}" class="card-img-top" alt="Foto de {{ $barber->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $barber->name }}</h5>
                            <p class="card-text">{{ $barber->specialty }}</p>
                            <div class="text-center icon-links">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Pie de página -->
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
