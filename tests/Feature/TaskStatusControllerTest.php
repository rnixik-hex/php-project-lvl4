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

    public function testStore(): void
    {
        $data = [
            'name' => 'Back-log'
        ];

        $response = $this->post('/task_statuses', $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', [
            'name' => 'Back-log',
        ]);
    }

    public function testStoreError(): void
    {
        $response = $this->post('/task_statuses', []);
        $response->assertSessionHas('flash_notification.0.level', 'danger');
        $response->assertRedirect();
    }

    public function testUpdate(): void
    {
        $taskStatus = TaskStatus::factory()->create([
            'name' => 'In progress',
        ]);

        $data = [
            'name' => 'Fixed name'
        ];

        $response = $this->put('/task_statuses/' . $taskStatus->id, $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', [
            'id' => $taskStatus->id,
            'name' => 'Fixed name',
        ]);
    }

    public function testDelete(): void
    {
        $taskStatus = TaskStatus::factory()->create([
            'name' => 'To delete',
        ]);

        $response = $this->delete('/task_statuses/' . $taskStatus->id);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('task_statuses', [
            'id' => $taskStatus->id,
        ]);
    }

    public function testDeleteDeleted(): void
    {
        $id = 999;

        $response = $this->delete('/task_statuses/' . $id);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
    }
}
