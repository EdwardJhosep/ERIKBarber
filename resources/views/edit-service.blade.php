<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Servicio</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Editar Servicio</h1>

    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="serviceName">Nombre del Servicio:</label>
            <input type="text" class="form-control" id="serviceName" name="serviceName" value="{{ $service->name }}" required>
        </div>

        <div class="form-group">
            <label for="price">Precio:</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $service->price }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $service->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="photo">Seleccionar nueva foto (opcional):</label>
            <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Actualizar Servicio</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
