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
    /*
    $regiones = DB::select(
                        'SELECT regID, regNombre FROM regiones'
                );
    */
    $regiones = DB::table('regiones')->get();

    //retornamos vista pasando datos
    return view('adminRegiones',
        [ 'regiones'=>$regiones ]
    );
});
Route::get('/agregarRegion', function(){
    return view('agregarRegion');
});
Route::post('/agregarRegion', function(){
    //capturar dato enviado por el form
    $regNombre = $_POST['regNombre'];
    //dar alta
    /*DB::insert(
            'INSERT INTO regiones
                         ( regNombre )
                  VALUES ( :regNombre )',
                  [ $regNombre ]
        );
    */
    DB::table('regiones')->insert( [ 'regNombre'=>$regNombre ] );
    //redirección a petición /adminregiones
    return redirect('/adminRegiones')
        ->with('mensaje', 'Región: '.$regNombre.' agregada correctamente');
});
########################################
### CRUD DE DESTINOS
Route::get('/adminDestinos', function(){
    // Obtenemos listado de destinos
    /* $destinos=DB::select(
                     'SELECT r.regNombre, d.destNombre, d.destPrecio
                         FROM destinos as d
                           INNER JOIN regiones AS r
                               ON d.regID = r.regID'
                   );
    */
    /*
     $destinos = DB::select(
                        'SELECT d.destNombre, d.regId, d.destPrecio,
                                r.regId, r.regNombre
                            FROM destinos d, regiones r
                            WHERE d.regId=r.regId'
                    );
    */
    $destinos = DB::table('destinos as d')
        ->join('regiones as r', 'd.regID', '=', 'r.regID')
        ->get();
    // Retornamos vista pasando datos
    return view('adminDestinos',
        ['destinos'=>$destinos]
    );
});

Route::get('/agregarDestino', function (){
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();

    //retornamos vista del form pasando regiones
    return view('agregarDestino',
                    [ 'regiones'=>$regiones ]
            );
});
Route::post('/agregarDestino', function(){
    //capturamos datos enviados por el form
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];

    //insertar datos en tabla destinos
    DB::table('destinos')
            ->insert(
                [
                    'destNombre'=>$destNombre,
                    'regID'=>$regID,
                    'destPrecio'=>$destPrecio,
                    'destAsientos'=>$destAsientos,
                    'destDisponibles'=>$destDisponibles
                ]
            );

    //redirección a panel de destinos + mensaje de alta ok
    return redirect('/adminDestinos')
                    ->with(
                        [
                            'mensaje'=>'Destino: '.$destNombre.' agregado correctamente.'
                        ]
                    );
});
