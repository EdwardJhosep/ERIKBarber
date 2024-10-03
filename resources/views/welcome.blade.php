<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ERIK Barber-Studio</title>
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
            color: #ffcc00; /* Color destacado */
            font-size: 1.2rem;
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
        .hero {
            background-image: url('imagenes/fondo2.jpg');
            background-size: cover;
            background-position: center;
            color: rgb(255, 255, 255);
            text-align: center;
            padding: 100px 0;
            position: relative;
        }
        .hero:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .hero h1 {
            font-size: 4rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
            z-index: 2;
        }
        .hero p {
            font-size: 1.5rem;
            z-index: 2;
        }
        .hero .btn {
            background-color: #ffcc00;
            color: #000;
            border-radius: 20px;
            padding: 10px 30px;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        }
        .hero .btn:hover {
            background-color: #ffd700;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        footer {
            background-color: #343a40;
            color: white;
        }
        .card-img-top {
            height: 200px; /* Ajusta la altura según sea necesario */
            object-fit: cover; /* Asegura que la imagen cubra todo el espacio sin distorsionarse */
        }
        /* Estilos para el texto de bienvenida */
        .welcome-text {
            font-size: 3rem; /* Tamaño de fuente inicial */
        }

        @media (max-width: 768px) {
            .welcome-text {
                font-size: 2.5rem; /* Tamaño de fuente en pantallas más pequeñas */
            }
        }

        @media (max-width: 576px) {
            .welcome-text {
                font-size: 2rem; /* Tamaño de fuente en móviles */
            }
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
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('welcome') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('servicios') }}">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('acerca') }}">Acerca de</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <h3 class="welcome-text">Bienvenido a ERIK Barber-Studio</h3>
        <p class="lead">Tu estilo, nuestra pasión</p>
    </header>

    <div class="container mt-5 pt-5">
        <div class="text-center my-4">
            <a href="https://wa.me/967463961" target="_blank" class="btn btn-success mr-2">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            <a href="https://www.instagram.com/suarez_barberstudio?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="btn btn-danger">
                <i class="fab fa-instagram"></i> Instagram
            </a>
        </div>

    <div class="container mt-5 pt-5">
        <section class="my-5">
            <h2 class="text-center">Nuestros Servicios</h2>
            <p class="text-center">Ofrecemos una variedad de servicios para satisfacer todas tus necesidades de estilo.</p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100"> <!-- Añadir h-100 aquí -->
                        <img src="/imagenes/cortecabello.jpg" class="card-img-top" alt="Asesoría de corte">
                        <div class="card-body">
                            <h5 class="card-title">Asesoría de Corte</h5>
                            <p class="card-text">Cortes personalizados con asesoría de expertos para realzar tu estilo.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="/imagenes/cortecabello.jpg" class="card-img-top" alt="Corte de cabello">
                        <div class="card-body">
                            <h5 class="card-title">Corte de Cabello</h5>
                            <p class="card-text">Cortes modernos y clásicos adaptados a tu estilo personal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="/imagenes/afeitado.jpg" class="card-img-top" alt="Ritual de barba">
                        <div class="card-body">
                            <h5 class="card-title">Ritual de Barba</h5>
                            <p class="card-text">Afeitado y arreglo de barba con productos de alta calidad.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="/imagenes/limpiezafacial.jpg" class="card-img-top" alt="Limpieza facial">
                        <div class="card-body">
                            <h5 class="card-title">Limpieza Facial</h5>
                            <p class="card-text">Cuidado de la piel para mantener un rostro fresco y limpio.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="/imagenes/decoloracion.jpg" class="card-img-top" alt="Servicio de decoloración">
                        <div class="card-body">
                            <h5 class="card-title">Servicio de Decoloración</h5>
                            <p class="card-text">Decoloración y tintes personalizados para un estilo único.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="/imagenes/ondulacion.jpg" class="card-img-top" alt="Servicio de ondulación">
                        <div class="card-body">
                            <h5 class="card-title">Servicio de Ondulación</h5>
                            <p class="card-text">Ondulación del cabello con técnicas avanzadas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="/imagenes/servicioadomicilio.jpg" class="card-img-top" alt="Servicio a Domicilio">
                        <div class="card-body">
                            <h5 class="card-title">Servicio a Domicilio</h5>
                            <p class="card-text">Disfruta de nuestros servicios desde la comodidad de tu hogar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
    <footer class="footer text-center">
        <div class="container">
            <p>© 2024 ERIK Barber-Studio. Todos los derechos reservados.</p>
            <p>
                <a href="https://www.facebook.com/erikbarberstudio" class="text-white"><i class="fab fa-facebook"></i> Facebook</a> | 
                <a href="#" class="text-white"><i class="fab fa-instagram"></i> Instagram</a>
            </p>
            <p>Dirección: Av. Girasoles 848, Amarilis 10003 | Teléfono: <a href="https://wa.me/967463961" class="text-white">967463961</a></p>
            <p>Desarrollado por Edward JR | Contacto: <a href="https://wa.me/921540347" class="text-white">921540347</a></p>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.navbar').addClass('scrolled');
            } else {
                $('.navbar').removeClass('scrolled');
            }
        });
    </script>
</body>
</html> 