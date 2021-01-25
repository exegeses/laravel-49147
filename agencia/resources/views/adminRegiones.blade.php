@extends('layouts.plantilla')

@section('contenido')
    <h1>Panel de administración de regiones</h1>

    @if( session('mensaje') )
        <div class="alert alert-success p-2">
            {{ session('mensaje') }}
        </div>
    @endif

    <table class="table table-borderless table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Región</th>
            <th colspan="2">
                <a href="/agregarRegion" class="btn btn-outline-secondary">
                    Agregar
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach( $regiones as $region )
            <tr>
                <td>{{ $region->regID }}</td>
                <td>{{ $region->regNombre }}</td>
                <td>
                    <a href="" class="btn btn-outline-secondary">
                        Modificar
                    </a>
                </td>
                <td>
                    <a href="" class="btn btn-outline-secondary">
                        Eliminar
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
