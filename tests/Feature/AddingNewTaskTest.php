<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddingNewTaskTest extends TestCase
{
    use RefreshDatabase; // empty database after every task
    use WithFaker; // use faker to produce fake data

    public function testAnyOneCanCreateTask()
    {
        // create fake task body
        $task = [
            'body' => $this->faker->sentence
        ];

        // submit the new task form
        $this->post('/', $task)
            ->assertRedirect('/');

        // check if new task was saved into database
        $this->assertDatabaseHas('tasks', $task);

        // visit homepage and see if this task was shown
        $this->get('/')
            ->assertSee($task['body']);
    }

    public function testSavingFailsIfNoTaskBodyProvided()
    {
        $this->post('/', [])->assertSessionHasErrors('body');
    }
}
