<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    private function as(string $role): static
    {
        return $this->actingAs(User::factory()->role($role)->create());
    }

    public function test_login_berhasil_dan_logout(): void
    {
        $user = User::factory()->role('admin')->create(['email' => 'a@x.test']);

        $this->post('/login', ['email' => 'a@x.test', 'password' => 'password'])->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);

        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_login_salah_ditolak(): void
    {
        User::factory()->create(['email' => 'a@x.test']);

        $this->post('/login', ['email' => 'a@x.test', 'password' => 'salah'])->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_tamu_diarahkan_ke_login(): void
    {
        foreach (['/users', '/materi', '/nilai', '/nilai-saya'] as $url) {
            $this->get($url)->assertRedirect('/login');
        }
    }

    public function test_admin_akses(): void
    {
        $this->as('admin');
        $this->get('/users')->assertOk();
        $this->get('/materi')->assertOk();
        $this->get('/nilai')->assertOk();
        $this->get('/nilai-saya')->assertForbidden();
    }

    public function test_dosen_akses(): void
    {
        $this->as('dosen');
        $this->get('/users')->assertForbidden();
        $this->get('/materi')->assertOk();
        $this->get('/materi/create')->assertOk();
        $this->get('/nilai')->assertOk();
        $this->get('/nilai-saya')->assertForbidden();
    }

    public function test_mahasiswa_akses(): void
    {
        $this->as('mahasiswa');
        $this->get('/users')->assertForbidden();
        $this->get('/materi')->assertOk();
        $this->get('/materi/create')->assertForbidden();
        $this->post('/materi', ['judul' => 'x'])->assertForbidden();
        $this->get('/nilai')->assertForbidden();
        $this->post('/nilai', [])->assertForbidden();
        $this->get('/nilai-saya')->assertOk();
    }

    public function test_dosen_bisa_buat_materi_dan_input_nilai(): void
    {
        $this->as('dosen');
        $mhs = User::factory()->role('mahasiswa')->create();

        $this->post('/materi', ['judul' => 'Basis Data'])->assertRedirect('/materi');
        $this->post('/nilai', ['mahasiswa_id' => $mhs->id, 'materi_id' => 1, 'nilai' => 90])->assertRedirect('/nilai');
        $this->assertDatabaseHas('nilai', ['mahasiswa_id' => $mhs->id, 'nilai' => 90]);
    }

    public function test_admin_bisa_tambah_pengguna(): void
    {
        $this->as('admin');
        $this->post('/users', ['name' => 'Baru', 'email' => 'b@x.test', 'password' => 'secret1', 'role' => 'dosen'])
            ->assertRedirect('/users');
        $this->assertDatabaseHas('users', ['email' => 'b@x.test', 'role' => 'dosen']);
    }
}
