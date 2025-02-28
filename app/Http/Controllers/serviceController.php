<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class serviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getServices()
    {
        $services = Service::all();

        if($services->isEmpty()){
            return response()->json(['message' => 'No se encontraron servicios'], 404);
        }
        return response()->json(['services' => $services], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:services|regex:/^[a-zA-Z\s]+$/',
            'amount' => 'required|numeric|min:0',
            'approximate_hours' => 'required|numeric|min:0'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $service = Service::create($validator->validated());

        return response()->json([
            'message' => 'Servicio creado',
            'service' => $service
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function getServiceById($id)
    {
        $service = Service::find($id);

        if(!$service){
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        return response()->json(['service' => $service], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateServiceById(Request $request, $id)
    {
        $service = Service::find($id);

        if(!$service){
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        $rules = [
            'name' => 'min:3|regex:/^[a-zA-Z\s]+$/',
            'amount' => 'numeric|min:0',
            'approximate_hours' => 'numeric|min:0'
        ];

        $validator = Validator::make($request->all(),array_keys($rules) );

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $service->fill($request -> only(array_keys($rules)));
        $service->save();

        return response()->json([
            'message' => 'Servicio actualizado',
            'service' => $service
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteService($id)
    {
        $service = Service::find($id);

        if(!$service){
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }
        $service->delete();
        return response()->json(['message' => 'Servicio eliminado'], 200);
    }
}
