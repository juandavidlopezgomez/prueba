<?php
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\CourseController;

Route::apiResource('students', StudentController::class);
Route::apiResource('courses', CourseController::class);

Route::get('students/{id}/courses', [StudentController::class, 'courses']);
Route::get('courses/top', [CourseController::class, 'topCourses']);
Route::post('courses/{courseId}/assign-student', [CourseController::class, 'assignStudent']);