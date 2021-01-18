<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <h1>Listado de regiones</h1>

        <div class="list-group col-4">
        @foreach( $regiones as $region )
            <span class="list-group-item list-group-item-action">
                {{ $region->regID }} - {{ $region->regNombre }}
            </span>
        @endforeach
        </div>

    </main>
</body>
</html>
