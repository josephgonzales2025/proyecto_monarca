<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCourses()
    {
        $course = Course::all();

        if($course->isEmpty()){
            return response()->json([
                'message' => 'No course found'
            ], 404);
        }
        return response()->json($course, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:courses|regex:/^[a-zA-Z\s]+$/',
            'description' => 'required|min:3',
            'duration' => 'required',
            'status' => 'required',
            'teacher_id' => 'required|exists:teachers,id',
            'local_id' => 'required|exists:locals,id'
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course = Course::create($validator->validated());

        return response()->json([
            'message' => 'Course created',
            'course' => $course
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function getCourseById($id)
    {
        $course = Course::find($id);

        if(!$course){
            return response()->json(['message' => 'Course not found'], 404);
        }

        return response()->json($course, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCourseById(Request $request, $id)
    {
        $course = Course::find($id);

        if(!$course){
            return response()->json(['message' => 'Course not found'], 404);
        }

        $rules = [
            'name' => 'min:3|regex:/^[a-zA-Z\s]+$/',
            'description' => 'min:3',
            'duration' => '',
            'status' => '',
            'teacher_id' => 'exists:teachers,id',
            'local_id' => 'exists:locals,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course->fill($request->only(array_keys($rules)));
        $course->save();

        return response()->json([
            'message' => 'Course updated',
            'course' => $course
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteCourse($id)
    {
        $course = Course::find($id);

        if(!$course){
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->delete();

        return response()->json([
            'message' => 'Course deleted'
        ], 200);
    }
}
