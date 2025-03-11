<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;

// Rutas para estudiantes
Route::resource('students', StudentController::class);

// Ruta para el top 3 de cursos - DEBE IR ANTES de la definición del resource
Route::get('/courses/top', [CourseController::class, 'topCourses'])->name('courses.top');

// Rutas para cursos
Route::resource('courses', CourseController::class);

// Ruta para asignar estudiantes a cursos
Route::post('/courses/{course}/assign-student', [CourseController::class, 'assignStudent'])->name('courses.assignStudent');

// Ruta para los cursos de un estudiante
Route::get('/students/{student}/courses', [StudentController::class, 'courses'])->name('students.courses');
// Rutas para la asignación de estudiantes a cursos
Route::get('/courses/{course}/assign', [CourseController::class, 'assign'])->name('courses.assign');

Route::delete('/courses/{course}/remove-student/{student}', [CourseController::class, 'removeStudent'])->name('courses.removeStudent');

// Ruta para los cursos de un estudiante
Route::get('/students/{student}/courses', [StudentController::class, 'courses'])->name('students.courses');