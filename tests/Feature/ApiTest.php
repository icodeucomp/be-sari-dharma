<?php

namespace Tests\Feature;

use App\Helpers\Cryptor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    private function personalClient(): void
    {
        app(ClientRepository::class)->createPersonalAccessGrantClient('Test', 'users');
    }

    private function actAsUser(): User
    {
        /** @var User $user */
        $user = User::factory()->createOne();
        Passport::actingAs($user, [], 'api');

        return $user;
    }

    private function enc(int $id): string
    {
        return (new Cryptor)->encrypt($id);
    }

    public function test_login_returns_token_and_rejects_bad_credentials(): void
    {
        $this->personalClient();
        User::factory()->create(['email' => 'a@b.test', 'password' => 'secret-pass']);

        $this->postJson('/api/login', ['email' => 'a@b.test', 'password' => 'wrong'])->assertStatus(401);
        $this->postJson('/api/login', [])->assertStatus(422);
        $this->postJson('/api/login', ['email' => 'a@b.test', 'password' => 'secret-pass'])
            ->assertOk()->assertJsonStructure(['user', 'token']);
    }

    public function test_register_requires_authentication(): void
    {
        $payload = ['name' => 'X', 'email' => 'x@y.test', 'password' => 'password123'];

        $this->postJson('/api/register', $payload)->assertStatus(401);

        $this->personalClient();
        $this->actAsUser();
        $this->postJson('/api/register', $payload)->assertStatus(201);
    }

    public function test_write_endpoints_require_authentication(): void
    {
        $this->postJson('/api/categories', ['name' => 'a', 'flag' => 'b'])->assertStatus(401);
    }

    public function test_search_is_case_insensitive_paginated_and_clamped(): void
    {
        $this->actAsUser();
        $this->postJson('/api/categories', ['name' => 'Heart', 'flag' => 'HealthArticle'])->assertStatus(201);

        $this->getJson('/api/categories?search=hEA&per_page=100000&page=-4')
            ->assertOk()
            ->assertJsonPath('data.total', 1)
            ->assertJsonPath('data.per_page', 100);

        $this->getJson('/api/categories?search=%25')->assertJsonPath('data.total', 0);
    }

    public function test_invalid_encrypted_id_is_404_not_500(): void
    {
        $this->getJson('/api/categories/not-an-id')->assertStatus(404);
        $this->getJson('/api/doctors/'.$this->enc(9999))->assertStatus(404);
        $this->getJson('/api/health-articles/x/garbage')->assertStatus(404);

        $this->actAsUser();
        $this->deleteJson('/api/categories/garbage')->assertStatus(404);
    }

    public function test_article_and_schedule_flow_with_filters(): void
    {
        $this->actAsUser();

        $category = $this->postJson('/api/categories', ['name' => 'General', 'flag' => 'HealthArticle'])->json('data.id');
        $doctor = $this->postJson('/api/doctors', ['name' => 'dr. Budi'])->assertStatus(201)->json('data.id');
        $specialist = $this->postJson('/api/specialist-services', [
            'name' => 'Internal Medicine', 'icon' => 'mdi', 'doctor_ids' => [],
        ])->assertStatus(201)->json('data.id');

        $this->postJson('/api/doctor-schedules', [
            'doctor_id' => $doctor,
            'specialist_id' => $specialist,
            'schedule' => [['day' => 'Senin', 'start_time' => '08:00', 'end_time' => '12:00']],
            'education_career' => [['title' => 'UI', 'start_year' => 2010, 'end_year' => 2014]],
        ])->assertStatus(201);

        $this->getJson('/api/doctor-schedules?day=Senin')->assertJsonPath('data.total', 1);
        $this->getJson('/api/doctor-schedules?day=Selasa')->assertJsonPath('data.total', 0);
        $this->getJson('/api/doctor-schedules?doctor_id=garbage')->assertOk()->assertJsonPath('data.total', 0);

        $article = $this->postJson('/api/health-articles', [
            'category_id' => $category,
            'title' => 'Healthy Living',
            'content' => 'isi',
            'related_doctors' => [$doctor, 'garbage'],
        ])->assertStatus(201);
        $this->assertSame(1, count($article->json('data.related_doctors')), 'invalid doctor ids must be dropped');

        $this->getJson('/api/health-articles?related_doctors='.urlencode($doctor))->assertJsonPath('data.total', 1);
        $this->getJson('/api/health-articles?related_doctors=garbage')->assertJsonPath('data.total', 0);
        $this->getJson('/api/health-articles?category_id=garbage')->assertJsonPath('data.total', 0);

        $id = $article->json('data.id');
        $this->getJson("/api/health-articles/healthy-living/{$id}")->assertOk()->assertJsonPath('data.title', 'Healthy Living');
        $this->getJson("/api/health-articles/wrong-slug/{$id}")->assertStatus(400);
        $this->deleteJson("/api/health-articles/{$id}")->assertOk();
    }

    public function test_updating_specialist_without_doctor_ids_keeps_schedule(): void
    {
        $this->actAsUser();
        $doctor = $this->postJson('/api/doctors', ['name' => 'dr. Ani'])->json('data.id');
        $specialist = $this->postJson('/api/specialist-services', [
            'name' => 'Pediatrics', 'icon' => 'mdi', 'doctor_ids' => [$doctor],
        ])->assertStatus(201)->json('data.id');

        $this->assertSame(1, $this->getJson('/api/doctor-schedules')->json('data.total'));

        $this->putJson("/api/specialist-services/{$specialist}", ['name' => 'Pediatrics 2', 'icon' => 'mdi'])->assertOk();

        $this->assertSame(1, $this->getJson('/api/doctor-schedules')->json('data.total'));
    }
}
