<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        TaskStatus::factory()->create([
            'name' => 'In progress',
        ]);

        TaskStatus::factory()->create([
            'name' => 'Done',
        ]);

        $response = $this->get('/task_statuses');
        $response->assertOk();
        $response->assertSee('In progress');
        $response->assertSee('Done');
    }
}
