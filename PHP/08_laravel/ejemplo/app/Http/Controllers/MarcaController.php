<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*$marcas = [
            "Mazda",
            "Mercedes",
            "Ford",
            "Peugeot",
            "Fiat",
            "Citroen",
            "Mitshubishi"
        ];*/
        $marcas = Marca::all();

        return view('marcas/index', ['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    
    //Para ver la información en detalle
    public function show(string $id)
    {
        $marca = Marca::find($id);

        return view('marcas/show', ["marca" => $marca]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
