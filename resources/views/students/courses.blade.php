@extends('layouts.app')

@section('title', 'Cursos del Estudiante')

@section('content')
    <h1>Cursos de {{ $student->name }} {{ $student->lastname }}</h1>
    
    <div class="mb-4">
        <a href="{{ route('students.show', $student->id) }}" class="btn btn-secondary">Volver a Detalles del Estudiante</a>
    </div>
    
    @if($student->courses->isEmpty())
        <div class="alert alert-info">
            Este estudiante no está inscrito en ningún curso.
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Horario</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($student->courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->schedule }}</td>
                        <td>{{ $course->start_date }}</td>
                        <td>{{ $course->end_date }}</td>
                        <td>
                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <form action="{{ route('courses.removeStudent', [$course->id, $student->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de querer eliminar este curso del estudiante?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection