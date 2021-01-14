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
        <h1>Procesando datos desde el enrutador</h1>

        @if( $nombre == 'marcos' )
            <div class="alert alert-success">
                Tu nombre es: {{ $nombre }}
            </div>
        @else
            <div class="alert alert-danger">
                usuario desconocido
            </div>
        @endif

        <div class="list-group col-4">
        @for( $n=1; $n<$numero; $n++ )
            <span class="list-group-item">
                item {{ $n }}
            </span>
        @endfor
        </div>

    </main>

</body>
</html>
