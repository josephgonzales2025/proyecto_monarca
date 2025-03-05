<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class appointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAppointments()
    {
        $appointments = Appointment::all();

        if($appointments->isEmpty()){
            return response()->json(['message' => 'No appointment found'], 404);
        }

        return response()->json($appointments, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createAppointment(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'client_id' => 'required|exists:clients,id',
            'local_id' => 'required|exists:locals,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'status' => 'required|in:pending,confirmed,cancelled',
            'is_paid' => 'required|boolean'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $appointment = Appointment::create($validator->validate());

        return response()->json([
            'message' => 'Appointment created',
            'appointment' => $appointment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function getAppointmentById($id)
    {
        $appointment = Appointment::find($id);

        if(!$appointment){
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        return response()->json($appointment, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAppointmentById(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if(!$appointment){
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $rules = [
            'client_id' => 'exists:clients,id',
            'local_id' => 'exists:locals,id',
            'service_id' => 'exists:services,id',
            'appointment_date' => 'date|after_or_equal:today',
            'appointment_time' => 'date_format:H:i',
            'status' => 'in:pending,confirmed,cancelled',
            'is_paid' => 'boolean'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $appointment->fill($request->only(array_keys($rules)));
        $appointment->save();

        return response()->json([
            'message' => 'Appointment update',
            'appointment' => $appointment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteAppointment($id)
    {
        $appointment = Appointment::find($id);

        if(!$appointment){
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted'], 200);
    }
}
