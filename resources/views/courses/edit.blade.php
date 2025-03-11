@extends('layouts.app')

@section('title', 'Editar Curso')

@section('content')
    <h1>Editar Curso</h1>

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $course->name }}" required>
        </div>
        <div class="form-group">
            <label for="schedule">Horario:</label>
            <input type="text" name="schedule" id="schedule" class="form-control" value="{{ $course->schedule }}" required>
        </div>
        <div class="form-group">
            <label for="start_date">Fecha de Inicio:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $course->start_date }}" required>
        </div>
        <div class="form-group">
            <label for="end_date">Fecha de Fin:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $course->end_date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection