<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class teacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getTeachers()
    {
        $teachers = Teacher::all();

        if($teachers->isEmpty()){
            return response()->json(['message' => "No teachers found"], 404);
        }
        return response()->json($teachers, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createTeacher(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|regex:/^[a-zA-Z\s]+$/',
            'dni' => 'required|unique:teachers|regex:/^[0-9]{8}$/',
            'birthdate' => 'required|date',
            'age' => 'required|integer|min:18',
            'local_id' => 'required|exists:locals,id',
            'specialty' => 'required|regex:/^[a-zA-Z\s]+$/',
            'days' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $teacher = Teacher::create($validator->validate());

        return response()->json([
            'message' => 'Teacher created',
            'teacher' => $teacher
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function getTeacherById($id)
    {
        $teacher = Teacher::find($id);

        if(!$teacher){
            return response()->json(['message' => 'Teacher not found'], 404);
        }
        return response()->json($teacher, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTeacherById(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if(!$teacher){
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $rules = [
            'name' => 'min:3|regex:/^[a-zA-Z\s]+$/',
            'dni' => 'unique:teachers|regex:/^[0-9]{8}$/',
            'birthdate' => 'date',
            'age' => 'integer|min:18',
            'local_id' => 'exists:locals,id',
            'specialty' => 'regex:/^[a-zA-Z\s]+$/',
            'days' => '',
            'start_time' => '',
            'end_time' => ''
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $teacher->fill($request->only(array_keys($rules)));
        $teacher->save();

        return response()->json([
            'message' => 'Teacher updated',
            'teacher' => $teacher
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteTeacher($id)
    {
        $teacher = Teacher::find($id);

        if(!$teacher){
            return response()->json(['message' => 'Teacher not found'], 404);
        }
        $teacher->delete();
        
        return response()->json(['message' => 'Teacher deleted', 200]);
    }
}
