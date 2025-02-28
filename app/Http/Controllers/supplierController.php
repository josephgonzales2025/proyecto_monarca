<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class supplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getSuppliers()
    {
        $suppliers = Supplier::all();

        if($suppliers->isEmpty()){
            return response()->json(['message' => 'No se encontraron proveedores'], 404);
        }
        return response()->json(['suppliers' => $suppliers], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createSupplier(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ruc' => 'required|unique:suppliers|regex:/^[12][0-9]{10}$/',
            'name' => 'required|min:3|unique:suppliers|regex:/^[a-zA-Z\s\.]+$/',
            'address' => 'required|min:3',
            'phone' => 'required|regex:/^[9][0-9]{8}$/',
            'email' => 'required|email',
            'contact' => 'required|min:3|regex:/^[a-zA-Z\s]+$/'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $supplier = Supplier::create($validator->validated());

        return response()->json([
            'message' => 'Proveedor creado',
            'supplier' => $supplier
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function getSupplierById($id)
    {
        $supplier = Supplier::find($id);

        if(!$supplier){
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }

        return response()->json($supplier, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSupplierById(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        if(!$supplier){
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }

        $rules = [
            'ruc' => 'sometimes|regex:/^[12][0-9]{10}$/',
            'name' => 'sometimes|min:3|regex:/^[a-zA-Z\s]+$/',
            'address' => 'sometimes|min:3',
            'phone' => 'sometimes|regex:/^[0-9]{9}$/',
            'email' => 'sometimes|email',
            'contact' => 'sometimes|min:3|regex:/^[a-zA-Z\s]+$/',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $supplier->fill($request->only(array_keys($rules)));
        $supplier->save();

        return response()->json([
            'message' => 'Proveedor actualizado',
            'supplier' => $supplier
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteSupplier(string $id)
    {
        $supplier = Supplier::find($id);

        if(!$supplier){
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }

        $supplier->delete();

        return response()->json(['message' => 'Proveedor eliminado'], 200);
    }
}
