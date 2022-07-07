<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CourseController,
    ModuleController,
    LessonController
};

Route::apiResource('/modules/{module}/lessons', LessonController::class);
Route::apiResource('/courses/{course}/modules', ModuleController::class);
Route::apiResource('/courses', CourseController::class);

Route::get('/', function () {
    return response()->json(['message' => 'ok']);
});
