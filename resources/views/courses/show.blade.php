@extends('layouts.app')

@section('title', 'Detalle del Curso')

@section('content')
    <h1>Detalle del Curso</h1>
    
    <div class="mb-4">
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Volver a la Lista</a>
        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('courses.assign', $course->id) }}" class="btn btn-primary">Asignar Estudiantes</a>
    </div>
    
    <div class="card">
        <div class="card-header">
            Información del Curso
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $course->name }}</h5>
            <p class="card-text"><strong>Horario:</strong> {{ $course->schedule }}</p>
            <p class="card-text"><strong>Fecha de Inicio:</strong> {{ $course->start_date }}</p>
            <p class="card-text"><strong>Fecha de Fin:</strong> {{ $course->end_date }}</p>
            <p class="card-text"><strong>Número de Estudiantes:</strong> {{ $course->students->count() }}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Estudiantes Asignados
        </div>
        <div class="card-body">
            @if($course->students->isEmpty())
                <p>No hay estudiantes asignados a este curso.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course->students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->lastname }}</td>
                                <td>{{ $student->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection