<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contacto</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('acerca') }}">Acerca de</a>
                    </li>
                    <li class="nav-item active">
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
        <h1 class="text-center">Contacto</h1>
        <p class="text-center">Estamos aquí para ayudarte. Si tienes alguna pregunta o deseas reservar una cita, no dudes en contactarnos.</p>
        

        <hr class="my-4">
        
        <h2 class="text-center">Ubicación</h2>
        <p class="text-center">Estamos ubicados en:</p>
        <p class="text-center"><strong>Av. Girasoles 848, Amarilis 10003</strong></p>
        
        <!-- Integrando el iframe de Google Maps -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3210.6068472718057!2d-76.2429210076008!3d-9.937703570899242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!1s0x91a7c3dd2f1153dd%3A0x6f76e4eb58bd6126!5e0!3m2!1ses-419!2spe!4v1727593651375!5m2!1ses-419!2spe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

        <hr class="my-4">
        
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
