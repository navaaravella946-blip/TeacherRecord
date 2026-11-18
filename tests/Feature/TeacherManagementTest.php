<?php

namespace Tests\Feature;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_teacher_can_be_created_and_found_by_search(): void
    {
        $response = $this->post(route('teachers.store'), [
            'name' => 'Maya Chen',
            'email' => 'maya@example.com',
            'phone' => '555-0101',
            'subject' => 'Mathematics',
            'status' => 'active',
        ]);

        $response->assertRedirect(route('teachers.index'));
        $this->assertDatabaseHas('teachers', [
            'name' => 'Maya Chen',
            'email' => 'maya@example.com',
            'subject' => 'Mathematics',
        ]);

        $this->get(route('teachers.index', ['search' => 'Mathematics']))
            ->assertOk()
            ->assertSee('Maya Chen');
    }

    public function test_teacher_can_be_updated_and_deleted(): void
    {
        $teacher = Teacher::create([
            'name' => 'Jordan Lee',
            'email' => 'jordan@example.com',
            'subject' => 'Science',
            'status' => 'active',
        ]);

        $this->put(route('teachers.update', $teacher), [
            'name' => 'Jordan Lee',
            'email' => 'jordan@example.com',
            'subject' => 'Biology',
            'status' => 'inactive',
        ])->assertRedirect(route('teachers.index'));

        $this->assertDatabaseHas('teachers', [
            'id' => $teacher->id,
            'subject' => 'Biology',
            'status' => 'inactive',
        ]);

        $this->delete(route('teachers.destroy', $teacher))
            ->assertRedirect(route('teachers.index'));

        $this->assertDatabaseMissing('teachers', ['id' => $teacher->id]);
    }
}
