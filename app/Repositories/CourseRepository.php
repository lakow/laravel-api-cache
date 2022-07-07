<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $course)
    {
        $this->entity = $course;
    }

    public function getAllCourses()
    {
        return Cache::remember('courses', 60, function () {
            return $this->entity
                    ->with('modules.lessons')
                    ->get();
        });
    }

    public function createNewCourse(array $data)
    {
        return $this->entity->store($data);
    }

    public function getCourseByUuid(string $identify, bool $loadRelationships = true)
    {
        $query = $this->entity;

        if ($loadRelationships) {
            $query->with('modules.lessons');
        }
                    
        return $query->where('uuid', $identify)->firstOrFail();
    }

    public function deleteCourseByUuid(string $identify)
    {
        $corse = $this->getCourseByUuid($identify, false);

        Cache::forget('courses');

        return $corse->delete();
    }

    public function updateCourse(string $identify, array $data)
    {
        $corse = $this->getCourseByUuid($identify, false);

        Cache::forget('courses');

        return $corse->update($data);
    }
}
