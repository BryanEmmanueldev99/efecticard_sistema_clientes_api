<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::get();
        return response()->json($clientes);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|max:100',
            'telefono' => 'required|min_digits:10|max_digits:10|numeric',
            'email' => 'required|max:100|email'
        ];
        $validator = Validator::make($request->input(), $rules);

        if($validator->fails()):
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        endif;

        //si todo sale bien
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->save();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
    }
}
