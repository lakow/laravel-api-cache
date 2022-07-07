<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\LessonService;
use App\Http\Requests\StoreUpdateLesson;
use App\Http\Resources\LessonResource;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($module)
    {
        $modules = $this->lessonService->getLessonsByModule($module);

        return LessonResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLesson $request, $module)
    {
        $module = $this->lessonService->createNewLesson($module, $request->validated());

        return new LessonResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $module
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function show($module, $identify)
    {
        $module = $this->lessonService->getLessonByModule($module, $identify);

        return $module;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLesson $request, $module, $identify)
    {
        $this->lessonService->updateModule($module, $identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function destroy($module, $identify)
    {
        $this->lessonService->deleteLesson($identify);

        return response()->json([], 204);
    }
}
