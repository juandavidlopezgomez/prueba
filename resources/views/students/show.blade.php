@extends('layouts.app')

@section('title', 'Detalle del Estudiante')

@section('content')
    <h1>Detalle del Estudiante</h1>
    
    <div class="mb-4">
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Volver a la Lista</a>
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('students.courses', $student->id) }}" class="btn btn-primary">Ver Cursos</a>
    </div>
    
    <div class="card">
        <div class="card-header">
            Información del Estudiante
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $student->name }} {{ $student->lastname }}</h5>
            <p class="card-text"><strong>Edad:</strong> {{ $student->age }}</p>
            <p class="card-text"><strong>Correo Electrónico:</strong> {{ $student->email }}</p>
            <p class="card-text"><strong>Número de Cursos:</strong> {{ $student->courses->count() }}</p>
        </div>
    </div>
@endsection