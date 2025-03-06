<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class scheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getSchedules()
    {
        $schedules = Schedule::all();

        if($schedules->isEmpty()){
            return response()->json(['message' => 'No schedules found'], 404);
        }
        return response()->json($schedules, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createSchedule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'days' => 'required',
            'start_time' => 'required|date_format:H:i', // Valida que sea una hora en formato HH:MM',
            'end_time' => 'required|date_format:H:i|after:start_time' // Asegura que la hora final sea después de la de inicio
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $schedule = Schedule::create($validator->validate());

        return response()->json([
            'message' => 'Schedule created',
            'student' => $schedule
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function getScheduleById(string $id)
    {
        $schedule = Schedule::find($id);

        if(!$schedule){
            return response()->json(['message' => 'Schedule not found'], 404);
        }
        return response()->json($schedule, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateScheduleById(Request $request, string $id)
    {
        $schedule = Schedule::find($id);

        if(!$schedule){
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        $rules = [
            'course_id' => 'exists:courses,id',
            'days' => '',
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i|after:start_time'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $schedule->fill($request->only(array_keys($rules)));
        $schedule->save();

        return response()->json([
            'message' => 'Schedule updated',
            'student' => $schedule
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteSchedule(string $id)
    {
        $schedule = Schedule::find($id);

        if(!$schedule){
            return response()->json(['message' => 'Schedule not found'], 404);
        }

        $schedule->delete();
        return response()->json(['message' => 'Schedule deleted']);
    }
}
