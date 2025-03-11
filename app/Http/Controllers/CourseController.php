<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student; 
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Curso creado correctamente.');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $course = Course::findOrFail($id);
        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Curso eliminado correctamente.');
    }
    
public function topCourses()
{
    // Obtén el top 3 de cursos con más estudiantes en los últimos 6 meses
    $topCourses = Course::withCount('students')
        ->where('start_date', '>=', now()->subMonths(6)) // Filtra cursos de los últimos 6 meses
        ->orderBy('students_count', 'desc') // Ordena por número de estudiantes (de mayor a menor)
        ->take(3) // Limita a 3 cursos
        ->get();

    // Retorna la vista con los cursos
    return view('courses.top', compact('topCourses'));
}
public function assign($id)
{
    $course = Course::findOrFail($id);
    
    // Obtener estudiantes que NO están asignados a este curso
    $availableStudents = Student::whereDoesntHave('courses', function($query) use ($id) {
        $query->where('courses.id', $id);
    })->get();
    
    return view('courses.assign', compact('course', 'availableStudents'));
}

public function assignStudent(Request $request, $courseId)
{
    $request->validate([
        'student_id' => 'required|exists:students,id'
    ]);
    
    $course = Course::findOrFail($courseId);
    
    // Verificar si el estudiante ya está asignado al curso
    if ($course->students()->where('students.id', $request->student_id)->exists()) {
        return redirect()->back()->with('error', 'El estudiante ya está asignado a este curso.');
    }
    
    $course->students()->attach($request->student_id, ['created_at' => now(), 'updated_at' => now()]);
    
    return redirect()->route('courses.assign', $courseId)
        ->with('success', 'Estudiante asignado correctamente al curso.');
}

public function removeStudent($courseId, $studentId)
{
    $course = Course::findOrFail($courseId);
    $course->students()->detach($studentId);
    
    return redirect()->route('courses.assign', $courseId)
        ->with('success', 'Estudiante eliminado del curso correctamente.');
}
}