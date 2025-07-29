<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    // প্রতিটি টেস্টের আগে DB রিসেট হবে
    \Illuminate\Foundation\Testing\RefreshDatabase::class;
});

// uses(RefreshDatabase::class);


it('fails when email is missing', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Mister Kashem',
        'role' => 'customer',
        'password' => 'password123',
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['email']);
});

it('fails when password is too short', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Mister Kashem',
        'email' => 'solaimanm@example.com',
        'role' => 'customer',
        'password' => '123',
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['password']);
});

it('fails when email already exists', function () {
    User::factory()->create(['email' => 'solaimanm@example.com']);

    $response = $this->postJson('/api/register', [
        'name' => 'Duplicate User',
        'email' => 'solaimanm@example.com',
        'role' => 'customer',
        'password' => 'password123',
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['email']);
});
