<?php

namespace App\Service;

use App\Repositories\{
    CourseRepository,
    ModuleRepository
};

class ModuleService
{
    protected $moduleRepository;

    protected $courseRepository;

    public function __construct(
        ModuleRepository $moduleRepository, 
        CourseRepository $courseRepository
    ) {
        $this->moduleRepository = $moduleRepository;
        $this->curseRepository = $courseRepository;
    }

    public function getModulesByCourses(string $course)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->moduleRepository->getModuleCourse($course->id);
    }

    public function createNewModule(string $course, array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->moduleRepository->createNewModule($course->id ,$data);
    }

    public function getModuleByCourse(string $course, string $identify)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->moduleRepository->getModuleByCourse($course->id, $identify);
    }

    public function deleteCourse(string $identify)
    {
        return $this->moduleRepository->deleteModuleByUuid($identify);
    }

    public function updateModule(string $course, string $identify, array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->moduleRepository->updateModuleByUuid($course->id, $identify, $data);
    }
}
