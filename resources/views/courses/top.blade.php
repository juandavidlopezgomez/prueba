@extends('layouts.app')

@section('title', 'Top 3 Cursos')

@section('content')
    <h1>Top 3 Cursos con Más Estudiantes en los Últimos 6 Meses</h1>

    @if ($topCourses->isEmpty())
        <div class="alert alert-info">No hay cursos registrados en los últimos 6 meses.</div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Horario</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Número de Estudiantes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topCourses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->schedule }}</td>
                        <td>{{ $course->start_date }}</td>
                        <td>{{ $course->end_date }}</td>
                        <td>{{ $course->students_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection