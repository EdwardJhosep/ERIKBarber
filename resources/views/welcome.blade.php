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
        <div class="form-container">
            <h1>Consultar Citas</h1>
            <form action="{{ route('crearCitasEnBlanco') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="form-control" required
                        min="{{ date('Y-m-d') }}"
                        max="{{ date('Y-m-d', strtotime('+7 days')) }}">
                    <small class="form-text text-muted">Verifica las citas disponibles.</small> <!-- Mensaje adicional -->
                </div>
                <button type="submit" class="btn btn-success w-100">Crear Cita</button>
            </form>
        <br><br>
            @if(isset($citas))
            <div class="table-container">
                <h2 class="text-center">Citas para el {{ $fecha }}</h2>
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Hora</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($citas as $cita)
                            <tr>
                                <td>{{ $cita->appointment_time }}</td>
                                <td>{{ $cita->phone_number ?: 'No asignado' }}</td>
                                <td>{{ $cita->status }}</td>
                                <td>
                                    @if(strtolower($cita->status) === 'confirmado') <!-- Si el estado es 'confirmado', mostrar el texto -->
                                        <span class="text-danger">Hora ocupada</span>
                                    @else
                                        @if(strtolower($cita->status) !== 'pendiente') <!-- Si el estado no es 'pendiente', mostrar el botón -->
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reservarModal" data-id="{{ $cita->id }}">Reservar</button>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
        
    
        <!-- Modal para Reservar Cita -->
        <div class="modal fade" id="reservarModal" tabindex="-1" aria-labelledby="reservarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reservarModalLabel">Reservar Cita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="reservarForm" action="{{ route('actualizarCita') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmReservation()">
                            @csrf
                            <input type="hidden" id="cita_id" name="cita_id">
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Número de Teléfono:</label>
                                <input type="text" id="telefono" name="phone_number" class="form-control" required>
                            </div>
                            <h1>La cita se reserva con 2 soles de adelanto.</h1>
                            <div class="mb-3">
                                <label for="fotopago" class="form-label">Foto de Pago:</label>
                                <input type="file" id="fotopago" name="fotopagocita" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado:</label>
                                <input type="text" id="estado" name="estado" class="form-control" value="pendiente" readonly>
                            </div>
                            <div class="mb-3 text-center">
                                <img src="/imagenes/yape.jpg" alt="QR Yape" class="img-fluid mb-2" style="max-width: 100%; height: auto;">
                            </div>
                            <button type="submit" class="btn btn-success">Reservar Cita</button>
                        </form>
                    </div>
                    
                    <script>
                        function confirmReservation() {
                            return confirm("¿Está seguro de que desea reservar esta cita?"); // Muestra el cuadro de confirmación
                        }
                    </script>
                    
                </div>
            </div>
        </div>
    
        <!-- jQuery (Opcional) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <!-- Popper.js (Opcional) -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <!-- Bootstrap JS (4.5.2) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                // Establecer la fecha actual como valor del campo de fecha
                var today = new Date().toISOString().split('T')[0];
                document.getElementById("fecha").value = today;
    
                $('#reservarModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Botón que activó el modal
                    var citaId = button.data('id') // Extraer información de data-* atributos
                    var modal = $(this)
                    modal.find('#cita_id').val(citaId) // Establecer el ID de la cita en el campo oculto
                });
            });
        </script>
        <section class="my-5">
            <h2 class="text-center">Nuestros Servicios</h2>
            <p class="text-center">Ofrecemos una variedad de servicios para satisfacer todas tus necesidades de estilo.</p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
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
                            <p class="card-text">Decoloraciones con técnicas modernas para un look atrevido.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="/imagenes/ondulacion.jpg" class="card-img-top" alt="Servicio de ondulación">
                        <div class="card-body">
                            <h5 class="card-title">Servicio de Ondulación</h5>
                            <p class="card-text">Ondas y rizos que añaden volumen y textura a tu cabello.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="/imagenes/servicioadomicilio.jpg" class="card-img-top" alt="Servicio a domicilio">
                        <div class="card-body">
                            <h5 class="card-title">Servicio a Domicilio</h5>
                            <p class="card-text">Llevamos el servicio hasta tu puerta con la mejor calidad.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="text-center text-white py-4">
        <div class="container">
            <p>&copy; 2024 ERIK Barber-Studio. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cambia el color de fondo de la navbar al desplazarse
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });
        });
    </script>
</body>
</html>
