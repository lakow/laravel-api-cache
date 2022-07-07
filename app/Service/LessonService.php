<?php

namespace App\Service;

use App\Repositories\{
    LessonRepository,
    ModuleRepository
};

class LessonService
{
    protected $lessonRepository;

    protected $moduleRepository;

    public function __construct(
        LessonRepository $lessonRepository, 
        ModuleRepository $moduleRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function getLessonsByModule(string $module)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);

        return $this->lessonRepository->getLessonModule($module->id);
    }

    public function createNewLesson(string $module, array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);

        return $this->lessonRepository->createNewLesson($module->id ,$data);
    }

    public function getLessonByModule(string $module, string $identify)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);

        return $this->lessonRepository->getLessonByModule($module->id, $identify);
    }

    public function deleteLesson(string $identify)
    {
        return $this->lessonRepository->deleteLessonByUuid($identify);
    }

    public function updateModule(string $module, string $identify, array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);

        return $this->lessonRepository->updateLessonByUuid($module->id, $identify, $data);
    }
}
