<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class localController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getLocals()
    {
        $locals = Local::all();

        if ($locals->isEmpty()){
            return response()->json(['message' => 'No se encontraron locales'],404);
        }
        return response()->json(['locals' => $locals], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createLocals(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|regex:/^[a-zA-Z\s]+$/',
            'cellphone' => 'required|unique:locals|regex:/^[0-9]{9}$/',
            'address' => 'required|min:3|unique:locals',
            'responsible' => 'required|min:3|unique:locals|regex:/^[a-zA-Z]+$/',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $local = Local::create($validator->validated());

        return response()->json([
            'message' => 'Local creado',
            'local' => $local
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function getLocalById($id)
    {
        $local = Local::find($id);

        if(!$local){
            return response()->json(['message' => 'Local no encontrado'], 404);
        }

        return response()->json($local, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateLocalById(Request $request, $id)
    {
        $local = Local::find($id);

        if(!$local){
            return response()->json(['message' => 'Local no encontrado'],404);
        }
        
        $rules = [
            'name' => 'sometimes|min:3|regex:/^[a-zA-Z\s]+$/',
            'cellphone' => 'sometimes|unique:locals|regex:/^[0-9]{9}$/',
            'address' => 'sometimes|min:3|unique:locals',
            'responsible' => 'sometimes|min:3|regex:/^[a-zA-Z]+$/|unique:locals',
            'status' => 'sometimes'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $local->fill($request->only(array_keys($rules)));
        $local->save();

        return response()->json([
            'message' => 'Local actualizado',
            'local' => $local
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteLocal($id)
    {
        $local = Local::find($id);

        if(!$local){
            return response()->json(['message' => 'Local no encontrado'], 404);
        }

        $local->delete();

        return response()->json(['message' => 'Local eliminado'], 200);
    }
}
