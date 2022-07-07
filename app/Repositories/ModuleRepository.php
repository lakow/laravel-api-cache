<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getModuleCourse(int $courseId)
    {
        return $this->entity->where('course_id', $courseId)->get();
    }

    public function createNewModule(int $courseId, array $data)
    {
        $data['course_id'] = $courseId;
        return $this->entity->create($data);
    }

    public function getModuleByCourse(int $courseId, string $identify)
    {
        return $this->entity
                    ->where('course_id', $courseId)
                    ->where('uuid', $identify)
                    ->firstOrFail();
    }

    public function getModuleByUuid(string $identify)
    {
        return $this->entity
                    ->where('uuid', $identify)
                    ->firstOrFail();
    }

    public function deleteModuleByUuid(string $identify)
    {
        $module = $this->getModuleByUuid($identify);

        return $module->delete();
    }

    public function updateModuleByUuid(int $courseId, string $identify, array $data)
    {
        $data['course_id'] = $courseId;
        $module = $this->getModuleByUuid($identify);

        return $module->update($data); 
    }
}
