<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $course = Course::create($request->all());
        return response()->json($course, 201);
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return response()->json($course);
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return response()->json($course);
    }

    public function destroy($id)
    {
        Course::destroy($id);
        return response()->json(null, 204);
    }

    public function topCourses()
    {
        $courses = Course::withCount('students')
            ->orderBy('students_count', 'desc')
            ->take(3)
            ->get();
        return response()->json($courses);
    }

    public function assignStudent(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $course->students()->attach($request->student_id);
        return response()->json($course);
    }
}