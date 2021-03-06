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

Route::get('/modificarRegion/{regID}', function ($regID){
    // obtenemos datos de la región filtrada por su id
    $region = DB::table('regiones')
        ->where('regID', $regID)
        ->first();

    //retornamos vista del form pasando datos
    return view('modificarRegion',
        [
            'region'=>$region
        ]
    );
});
Route::post('/modificarRegion', function(){
    //capturamos datos del form
    $regID = $_POST['regID'];
    $regNombre = $_POST['regNombre'];
    //modificar
    /* DB::update( 'UPDATE regiones
                     SET regNombre = ?
                     WHERE regID = ?', [ $regNombre, $regID ]);
     */
    DB::table('regiones')
        ->where('regID', $regID)
        ->update(
            [
                'regNombre'=>$regNombre
            ]
        );

    //retornar con mensaje de ok
    return redirect('/adminRegiones')
        ->with(
            [
                'mensaje'=>'Región: '.$regNombre.' modificada correctamente.'
            ]
        );
});

Route::get('/eliminarRegion/{regID}', function ($regID){
    //obtenemos datos de una región por su id
    $region = DB::table('regiones')
                    ->where('regID', $regID)
                    ->first();
    // retornamos vista y la pasamos datos de la región
    return view('eliminarRegion',
                [
                    'region'=>$region
                ]
        );
});
Route::post('/eliminarRegion', function(){
    $regNombre = $_POST['regNombre'];
    $regID = $_POST['regID'];
    /*
     * if( DB::table('destinos')->where('regID', $regID)->exists() ){
     *      no se puede eliminar porque hay un destino con esta región
     *      return redirect()->with();
     * }
     * */

    //borramos región
    DB::table('regiones')
            ->where('regID', $regID)
            ->delete();

    return redirect('/adminRegiones')
                ->with(
                    [ 'mensaje'=>'Región: '.$regNombre.' eliminada correctamente.' ]
                );
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
Route::get('/modificarDestino/{destID}', function($destID){
    //obtener datos de ese destino por su ID
    $destino = DB::table('destinos as d')
                        ->join('regiones as r', 'd.regID', '=', 'r.regID')
                        ->where('destID', $destID)
                        ->first();
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();
    //retornar veista del form +  pasar datos a la vista
    return view('modificarDestino',
                        [
                            'destino'=>$destino,
                            'regiones'=>$regiones
                        ]
            );
});

Route::post('/modificarDestino', function(){
    //capturamos datos
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    $destID = $_POST['destID'];
    //modificamos
    DB::table('destinos')
            ->where('destID', $destID)
            ->update(
                [
                    'destNombre' => $destNombre,
                    'destPrecio' => $destPrecio,
                    'regID' => $regID,
                    'destAsientos' => $destAsientos,
                    'destDisponibles' => $destDisponibles
                ]
            );
    //retornamos a admin con mensaje ok
    return redirect('/adminDestinos')
        ->with(
            [
                'mensaje'=>'Destino: '.$destNombre.' modificado correctamente.'
            ]
        );
});
