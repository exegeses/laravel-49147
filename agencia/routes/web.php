<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get( 'peticion', proceso );
Route::get('/prueba1', function () {
    return 'primera petición procesada';
});
Route::get( '/prueba2', function (){
    return view('primera');
} );
Route::get( '/prueba3', function(){
    $nombre = 'marcos';
    $numero = 15;
    return view('segunda',
                [
                    'nombre'=>$nombre,
                    'numero'=>$numero
                ]
            );
});
## listando regiones
Route::get('/regiones', function(){
    $regiones = DB::select(
                        'SELECT regID, regNombre
                            FROM regiones'
                    );
    return view('listaRegiones',
                    [ 'regiones'=>$regiones ]
            );
});

/*
Route::get('/inicio', function (){
    return view('inicio');
});
*/
Route::view('/inicio', 'inicio');

/*
 *  raw SQL
 *  DB::select();
 *  DB::insert();
 *  DB::update();
 *  BD::delete();
 * */


########################################
### CRUD DE REGIONES
Route::get('/adminRegiones', function(){
    //obtenemos listado de regiones
    $regiones = DB::select(
                        'SELECT regID, regNombre FROM regiones'
                );
    //retornamos vista pasando datos
    return view('adminRegiones',
                    [ 'regiones'=>$regiones ]
            );
});
########################################
### CRUD DE DESTINOS
Route::get('/adminDestinos', function(){
    // Obtenemos listado de destinos
    $destinos=DB::select(
                    'SELECT destID,destNombre,destPrecio
                            FROM destinos'
                  );
    // Retornamos vista pasando datos
    return view('adminDestinos',
                    ['destinos'=>$destinos]
            );
});
