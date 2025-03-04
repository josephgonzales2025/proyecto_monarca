<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getStudents()
    {
        $students = Student::all();

        if($students->isEmpty()){
            return response()->json(['message' => 'No students found'], 404);
        }
        return response()->json($students, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function createStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|regex:/^[a-zA-Z\s]+$/',
            'dni' => 'required|unique:students|regex:/^[0-9]{8}$/',
            'birthdate' => 'required|date',
            'age' => 'required|integer'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $student = Student::create($validator->validate());

        return response()->json([
            'message' => 'Student created',
            'student' => $student
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function getStudentById(string $id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($student, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStudentById(Request $request, string $id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()->json(['message' => 'Student not found'], 404);
        }

        $rules = [
            'name' => 'min:3|regex:/^[a-zA-Z\s]+$/',
            'dni' => 'unique:students|regex:/^[0-9]{8}$/',
            'birthdate' => 'date',
            'age' => 'integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $student->fill($request->only(array_keys($rules)));
        $student->save();

        return response()->json([
            'message' => 'Student updated',
            'student' => $student
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteStudent(string $id)
    {
        $student = Student::find($id);

        if(!$student){
            return response()->json(['message' => 'Student not found'], 404);
        }
        $student->delete();
        return response()->json(['message' => 'Student deleted'], 200);
    }
}
