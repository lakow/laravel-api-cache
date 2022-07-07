<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Lesson;
use App\Models\Module;

class LessonTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_lessons_by_module()
    {
        $module = Module::factory()->create();

        Lesson::factory()->count(10)->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/modules/{$module->uuid}/lessons");

        $response->assertStatus(200)
                ->assertJsonCount(10, 'data');
    }

    public function test_notfound_lessons_by_module()
    {
        $response = $this->getJson('/modules/value_fake/lessons');

        $response->assertStatus(404);
    }

    public function test_get_lesson_by_module()
    {
        $module = Module::factory()->create();

        $lesson = Module::factory()->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}");

        $response->assertStatus(200);
    }

    public function test_validations_create_lesson_by_module()
    {
        $module = Module::factory()->create();

        $response = $this->postJson("/modules/{$module->uuid}/lessons/", []);

        $response->assertStatus(422);
    }

    public function test_create_lesson_by_module()
    {
        $module = Module::factory()->create();

        $response = $this->postJson("/modules/{$module->uuid}/lessons/", [
            'module' => $module->uuid,
            'name' => 'Lesson 01'
        ]);

        $response->assertStatus(201);
    }

    public function test_validations_update_lesson_by_module()
    {
        $module = Module::factory()->create();
        $lesson = Lesson::factory()->create();

        $response = $this->putJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}", []);

        $response->assertStatus(422);
    }

    public function test_update_lesson_by_module()
    {
        $module = Module::factory()->create();
        $lesson = Lesson::factory()->create();

        $response = $this->putJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}", [
            'module' => $module->uuid,
            'name' => 'Lesson updated'
        ]);

        $response->assertStatus(200);
    }

    public function test_notfound_lesson_by_module()
    {
        $module = Module::factory()->create();

        $response = $this->deleteJson("/modules/{$module->uuid}/lessons/value_fake");

        $response->assertStatus(404);
    }

    public function test_delete_lesson_by_module()
    {
        $module = Module::factory()->create();
        $lesson = Lesson::factory()->create();

        $response = $this->deleteJson("/modules/{$module->uuid}/lessons/{$lesson->uuid}");

        $response->assertStatus(204);
    }
}
