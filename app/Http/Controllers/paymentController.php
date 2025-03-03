<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class paymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getPayments()
    {
        $payments = Payment::all();

        if($payments->isEmpty()){
            return response()->json(['message' => 'No payments found'], 404);
        }
        return response()->json($payments, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'amount' => 'required|numeric',
            'paymentDate' => 'required|date',
            'paymentStatus' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payment = Payment::create($validator->validate());

        return response()->json([
            'message' => 'Payment created',
            'student' => $payment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function getPaymentById($id)
    {
        $payment = Payment::find($id);

        if(!$payment){
            return response()->json(['message' => 'Payment not found'], 404);
        }
        return response()->json($payment, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePaymentById(Request $request, string $id)
    {
        $payment = Payment::find($id);

        if(!$payment){
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $rules = [
            'student_id' => 'exists:students,id',
            'course_id' => 'exists:courses,id',
            'teacher_id' => 'exists:teachers,id',
            'amount' => 'numeric',
            'paymentDate' => 'date',
            'paymentStatus' => ''
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payment->fill($request->only(array_keys($rules)));
        $payment->save();

        return response()->json([
            'message' => 'Student updated',
            'student' => $payment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePayment($id)
    {
        $payment = Payment::find($id);

        if(!$payment){
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->delete();
        return response()->json(['message' => 'Payment deleted']);
    }
}
