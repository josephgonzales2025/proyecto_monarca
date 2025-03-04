<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class enrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getEnrollments()
    {
        $enrollments = Enrollment::all();

        if($enrollments->isEmpty()){
            return response()->json(['message' => 'No enrollments found'],404);
        }
        return response()->json($enrollments, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createEnrollment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:students,id',
            'enrollment_date' => 'required|date'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $enrollment = Enrollment::create($validator->validate());

        return response()->json([
            'message' => 'Enrollment created',
            'student' => $enrollment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function getEnrollmentById($id)
    {
        $enrollment = Enrollment::find($id);

        if(!$enrollment){
            return response()->json(['message' => 'Enrollment not found'], 404);
        }
        return response()->json($enrollment, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateEnrollmentById(Request $request, string $id)
    {
        $enrollment = Enrollment::find($id);

        if(!$enrollment){
            return response()->json(['message' => 'Enrollment not found'], 404);
        }

        $rules = [
            'student_id' => 'exists:students,id',
            'course_id' => 'exists:students,id',
            'enrollment_date' => 'date'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $enrollment->fill($request->only(array_keys($rules)));
        $enrollment->save();

        return response()->json([
            'message' => 'Student updated',
            'student' => $enrollment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteEnrollment($id)
    {
        $enrollment = Enrollment::find($id);

        if(!$enrollment){
            return response()->json(['message' => 'Enrollment not found'], 404);
        }

        $enrollment->delete();
        return response()->json(['message' => 'Enrollment deleted']);
    }
}
