<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        // Obtén todos los estudiantes de la base de datos
        $students = Student::all();

        // Pasa la variable $students a la vista
        return view('students.index', compact('students'));
    }

    public function create()
{
    // Muestra el formulario para crear un nuevo estudiante
    return view('students.create');
}

    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'email' => 'required|email|unique:students,email',
        ]);

        // Crea un nuevo estudiante
        Student::create($request->all());

        // Redirige a la lista de estudiantes
        return redirect()->route('students.index')->with('success', 'Estudiante creado correctamente.');
    }

    public function show($id)
    {
        // Obtén el estudiante por su ID
        $student = Student::findOrFail($id);

        // Muestra la vista de detalles del estudiante
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        // Obtén el estudiante por su ID
        $student = Student::findOrFail($id);

        // Muestra el formulario de edición
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'email' => 'required|email|unique:students,email,' . $id,
        ]);

        // Obtén el estudiante por su ID
        $student = Student::findOrFail($id);

        // Actualiza los datos del estudiante
        $student->update($request->all());

        // Redirige a la lista de estudiantes
        return redirect()->route('students.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    public function destroy($id)
    {
        // Obtén el estudiante por su ID
        $student = Student::findOrFail($id);

        // Elimina el estudiante
        $student->delete();

        // Redirige a la lista de estudiantes
        return redirect()->route('students.index')->with('success', 'Estudiante eliminado correctamente.');
    }

public function courses($id)
{
    $student = Student::with('courses')->findOrFail($id);
    return view('students.courses', compact('student'));
}
}