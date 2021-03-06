<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenenos listado de marcas
        //$marcas = DB::table('marcas')->get();
        //$marcas = Marca::all();
        $marcas = Marca::paginate(5);
        //retornamos vista pasandole los datos
        return view('adminMarcas',
                        [ 'marcas'=>$marcas ]
                    );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //retornar vista del form para agregar marca
        return view('agregarMarca');
    }

    private function validarMarca(Request $request)
    {
        $request->validate(
            [
                'mkNombre'=>'required|min:2|max:50'
            ],
            [
                'mkNombre.required'=>'El campo "Nombre de la marca" es obligatorio.',
                'mkNombre.min'=>'El campo "Nombre de la marca" debe tener al menos 2 caractéres.',
                'mkNombre.max'=>'El campo "Nombre de la marca" debe tener 50 caractéres como máximo.'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$mkNombre = $_POST['mkNombre'];
        $mkNombre = $request->mkNombre;
        //validación
        $this->validarMarca($request);
        // instanciamos, asignamos valores y guardar
        $Marca = new Marca;
        $Marca->mkNombre = $mkNombre;
        $Marca->save();
        //retornar petición + mensaje
        return redirect('/adminMarcas')
                ->with(
                    [
                    'mensaje'=>'Marca: '.$mkNombre.' agregada correctamente'
                    ]
                );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //obtenemos datos de una marca
        $Marca = Marca::find($id);
        //retornamos a la vista pasando datos
        return view('modificarMarca',
                    [
                        'Marca'=>$Marca
                    ]
                );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $mkNombre = $request->mkNombre;
        //validamos
        $this->validarMarca($request);
        //obtenemos datos de la marca
        $Marca = Marca::find($request->idMarca);
        //asignamos
        $Marca->mkNombre = $mkNombre;
        //guardamos
        $Marca->save();
        //retornamos a redirección con mensaje
        return redirect('/adminMarcas')
            ->with(
                [
                    'mensaje'=>'Marca: '.$mkNombre.' modificada correctamente'
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
