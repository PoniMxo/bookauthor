<?php

namespace Tests\Controllers;

use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTests extends TestCase {

    public function testIndexReturnsDataInValidFormat() {

    $this->json('get', 'api/user')
         ->assertStatus(Response::HTTP_OK)
         ->assertJsonStructure(
             [
                 'data' => [
                     '*' => [
                         'id',
                         'first_name',
                         'last_name',
                         'email',
                         'created_at'
                     ]
                 ]
             ]
         );
  }
  public function testUserIsCreatedSuccessfully() {

    $payload = [
        'name' => $this->faker->firstName,
        'email' => $this->faker
    ];
    $this->json('post', 'api/user', $payload)
         ->assertStatus(Response::HTTP_CREATED)
         ->assertJsonStructure(
             [
                 'data' => [
                     'id',
                     'first_name',
                     'last_name',
                     'email',
                     'created_at'
                 ]
             ]
         );
    $this->assertDatabaseHas('users', $payload);
}

}
