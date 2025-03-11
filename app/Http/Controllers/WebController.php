<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('APP_URL') . '/api';
    }

    // Estudiantes
    public function estudiantes()
    {
        $response = Http::get($this->apiUrl . '/students');
        $estudiantes = $response->json()['data'] ?? [];
        
        return view('estudiantes.index', compact('estudiantes'));
    }
    
    public function crearEstudiante()
    {
        return view('estudiantes.create');
    }
    
    public function editarEstudiante($id)
    {
        $response = Http::get($this->apiUrl . '/students/' . $id);
        $estudiante = $response->json()['data'] ?? null;
        
        if (!$estudiante) {
            return redirect()->route('estudiantes.index')->with('error', 'Estudiante no encontrado');
        }
        
        return view('estudiantes.edit', compact('estudiante'));
    }
    
    public function verEstudiante($id)
    {
        $response = Http::get($this->apiUrl . '/students/' . $id);
        $estudiante = $response->json()['data'] ?? null;
        
        if (!$estudiante) {
            return redirect()->route('estudiantes.index')->with('error', 'Estudiante no encontrado');
        }
        
        $cursos = Http::get($this->apiUrl . '/students/' . $id . '/courses')->json()['data'] ?? [];
        
        return view('estudiantes.show', compact('estudiante', 'cursos'));
    }

    // Cursos
    public function cursos()
    {
        $response = Http::get($this->apiUrl . '/courses');
        $cursos = $response->json()['data'] ?? [];
        
        return view('cursos.index', compact('cursos'));
    }
    
    public function crearCurso()
    {
        return view('cursos.create');
    }
    
    public function editarCurso($id)
    {
        $response = Http::get($this->apiUrl . '/courses/' . $id);
        $curso = $response->json()['data'] ?? null;
        
        if (!$curso) {
            return redirect()->route('cursos.index')->with('error', 'Curso no encontrado');
        }
        
        return view('cursos.edit', compact('curso'));
    }
    
    public function verCurso($id)
    {
        $response = Http::get($this->apiUrl . '/courses/' . $id);
        $curso = $response->json()['data'] ?? null;
        
        if (!$curso) {
            return redirect()->route('cursos.index')->with('error', 'Curso no encontrado');
        }
        
        $estudiantes = Http::get($this->apiUrl . '/courses/' . $id . '/students')->json()['data'] ?? [];
        
        return view('cursos.show', compact('curso', 'estudiantes'));
    }
    
    public function topCursos()
    {
        $response = Http::get($this->apiUrl . '/courses/top');
        $cursos = $response->json()['data'] ?? [];
        
        return view('cursos.top', compact('cursos'));
    }
    
    // Asignaciones
    public function asignarEstudiante()
    {
        $estudiantes = Http::get($this->apiUrl . '/students')->json()['data'] ?? [];
        $cursos = Http::get($this->apiUrl . '/courses')->json()['data'] ?? [];
        
        return view('asignaciones.create', compact('estudiantes', 'cursos'));
    }
}