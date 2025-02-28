<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class paymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getPaymentMethods()
    {
        $paymentMethods = PaymentMethod::all();

        if($paymentMethods->isEmpty()) {
            return response()->json(['message' => 'No payment methods found'], 404);
        }
        
        return response()->json($paymentMethods, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createPaymentMethod(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'type_payment_method' => 'required|string|unique:payment_methods|regex:/^[a-zA-Z\s]+$/',
            'amount' => 'required|string|regex:/^[a-zA-Z]+$/'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $paymentMethod = PaymentMethod::create($validator->validated());

        return response()->json([
            'message' => 'Payment method created',
            'paymentMethod' => $paymentMethod
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function getPaymentMethodById($id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if(!$paymentMethod) {
            return response()->json(['message' => 'Payment method not found'], 404);
        }
        return response()->json($paymentMethod, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePaymentMethodById(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if(!$paymentMethod) {
            return response()->json(['message' => 'Payment method not found'], 404);
        }
        
        $rules = [
            'name' => 'string|regex:/^[a-zA-Z\s]+$/',
            'type_payment_method' => 'string|regex:/^[a-zA-Z\s]+$/',
            'amount' => 'string|regex:/^[a-zA-Z\s]+$/'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $paymentMethod->fill($request->only(array_keys($rules)));
        $paymentMethod->save();

        return response()->json([
            'message' => 'Payment method updated',
            'paymentMethod' => $paymentMethod
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePaymentMethod(string $id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if(!$paymentMethod) {
            return response()->json(['message' => 'Payment method not found'], 404);
        }

        $paymentMethod->delete();

        return response()->json(['message' => 'Payment method deleted'], 200);
    }
}
