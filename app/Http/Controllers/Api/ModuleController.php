<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Http\Requests\StoreUpdateModule;
use App\Service\ModuleService;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($curse)
    {
        $modules = $this->moduleService->getModulesByCourses($curse);

        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateModule $request, $curse)
    {
        $module = $this->moduleService->createNewModule($request->validated());

        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $curse
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function show($curse, $identify)
    {
        $module = $this->moduleService->getModuleByCourse($curse, $identify);

        return $module;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateModule $request, $curse, $identify)
    {
        $this->moduleService->updateModule($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function destroy($curse, $identify)
    {
        $this->moduleService->deleteCourse($identify);

        return response()->json([], 204);
    }
}
