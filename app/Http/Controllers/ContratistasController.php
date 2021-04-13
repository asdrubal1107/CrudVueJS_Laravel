<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contratistas;

class ContratistasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Contratistas = Contratistas::all(); //Retornamos todo de la BD
        return $Contratistas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Contratistas = new Contratistas();
        $Contratistas->nombre = $request->nombre;
        $Contratistas->apellido = $request->apellido;
        $Contratistas->tipodocumento = $request->tipodocumento;
        $Contratistas->documento = $request->documento;
        $Contratistas->estado = 1;
        $Contratistas->save();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Contratista = Contratistas::findOrFail($request->id); //Recibir parametro id del formulario
        $Contratista->nombre = $request->nombre;
        $Contratista->apellido = $request->apellido;
        $Contratista->tipodocumento = $request->tipodocumento;
        $Contratista->documento= $request->documento;
        $Contratista->estado = 1;
        $Contratista->update(); //Guardar cambios
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
