@extends('layouts.app')

@section('title', 'Asignar Estudiantes a Curso')

@section('content')
    <h1>Asignar Estudiantes al Curso: {{ $course->name }}</h1>

    <form action="{{ route('courses.assignStudent', $course->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_id">Estudiante:</label>
            <select name="student_id" id="student_id" class="form-control" required>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Asignar</button>
        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection