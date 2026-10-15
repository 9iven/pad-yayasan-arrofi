<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('can login via api with valid credentials', function () {
    $user = User::factory()->create([
        'email' => 'testuser@arrofii.or.id',
        'password' => Hash::make('secret123'),
        'is_super_admin' => true,
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'testuser@arrofii.or.id',
        'password' => 'secret123',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'message',
            'token',
            'user' => ['id', 'name', 'email', 'is_super_admin'],
        ])
        ->assertJson([
            'status' => 'success',
            'user' => [
                'email' => 'testuser@arrofii.or.id',
                'is_super_admin' => true,
            ],
        ]);
});

it('fails login via api with wrong password', function () {
    $user = User::factory()->create([
        'email' => 'wrongpass@arrofii.or.id',
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'wrongpass@arrofii.or.id',
        'password' => 'wrongpassword',
    ]);

    $response->assertStatus(401)
        ->assertJson([
            'status' => 'error',
            'message' => 'Email atau password salah.',
        ]);
});

it('can fetch authenticated user profile', function () {
    $user = User::factory()->create([
        'is_super_admin' => true,
    ]);

    $response = $this->actingAs($user, 'sanctum')->getJson('/api/user');

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'is_super_admin' => true,
            ],
        ]);
});

it('allows super admin to access admin routes', function () {
    $admin = User::factory()->create([
        'is_super_admin' => true,
    ]);

    $response = $this->actingAs($admin, 'sanctum')->getJson('/api/admin/check');

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'message' => 'Otorisasi berhasil. Anda memiliki akses sebagai Super Admin.',
        ]);
});

it('denies non-super admin from accessing admin routes with 403', function () {
    $regularUser = User::factory()->create([
        'is_super_admin' => false,
    ]);

    $response = $this->actingAs($regularUser, 'sanctum')->getJson('/api/admin/check');

    $response->assertStatus(403)
        ->assertJson([
            'status' => 'error',
            'message' => 'Akses ditolak. Fitur ini hanya untuk Super Admin.',
        ]);
});

it('can logout and delete token', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test_token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer ' . $token)
        ->postJson('/api/logout');

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'message' => 'Logout berhasil.',
        ]);

    expect($user->fresh()->tokens)->toBeEmpty();
});
