@extends('layouts.app')

@section('title', 'Asignar Estudiantes')

@section('content')
    <h1>Asignar Estudiantes al Curso: {{ $course->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-secondary">Volver a Detalles del Curso</a>
    </div>

    <div class="card">
        <div class="card-header">
            Asignar Nuevo Estudiante
        </div>
        <div class="card-body">
            <form action="{{ route('courses.assignStudent', $course->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="student_id" class="form-label">Seleccionar Estudiante</label>
                    <select name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror" required>
                        <option value="">Seleccione un estudiante</option>
                        @foreach($availableStudents as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} {{ $student->lastname }} ({{ $student->email }})</option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Asignar Estudiante</button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Estudiantes Actualmente Asignados
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course->students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->lastname }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <form action="{{ route('courses.removeStudent', [$course->id, $student->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de querer eliminar este estudiante del curso?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection