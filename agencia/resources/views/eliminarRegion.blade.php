@extends('layouts.plantilla')

    @section('contenido')
        <h1>Baja de una región</h1>

        <div class="bg-light col-6 mx-auto shadow rounded p-4 text-danger">
            Se eliminará la siguiente región
            <span class="lead">{{ $region->regNombre }}</span>



        </div>

    @endsection
