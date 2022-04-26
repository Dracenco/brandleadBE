<?php

namespace Tests\Feature;

use App\Models\Person;
use Tests\TestCase;

class PersonTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_user_can_create_user()
    {
        $this->withoutExceptionHandling();
        $data = $this->getUserMockContent();
        $this->post('/people', $data);
        //given no data prior the assert should return 1 person in total
        $this->assertCount(1, Person::all());
    }

    public function test_user_cannot_add_duplicate_user()
    {
        $this->withoutExceptionHandling();
        $data = $this->getUserMockContent();
        $this->post('/people', $data);
        //Inserting twice the same data would normally result in duplicates if no validation would be implemented
        $this->post('/people', $data);
        $this->assertNotEquals(2, Person::all());
    }

    private function getUserMockContent()
    {
        return [
            'name' => 'Test Name',
            'order' => '1',
        ];
    }

}
