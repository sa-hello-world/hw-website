<?php

namespace Feature\Controllers\Board;

use App\Enums\SponsorshipTier;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SponsorControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $chair;
    private User $unauthorized;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('app:sync-permissions');
        $this->unauthorized = User::factory()->create();
        $this->chair = User::factory()->create();
        $this->chair->assignRole('chairman');
        $this->actingAs($this->chair);
    }

    #[Test]
    public function test_index_displays_all_sponsors_with_counts(): void
    {
        Sponsor::factory()->count(2)->create(['tier' => SponsorshipTier::GOLD->value]);
        Sponsor::factory()->count(1)->create(['tier' => SponsorshipTier::SILVER->value]);

        $response = $this->get(route('sponsors.index'));

        $response->assertOk();
        $response->assertViewHas('sponsorCounts');
        $response->assertViewHas('sponsors');
    }

    #[Test]
    public function test_index_throws_403_when_unauthorized(): void
    {
        $this->actingAs($this->unauthorized);

        $response = $this->get(route('sponsors.index'));

        $response->assertForbidden();
    }

    #[Test]
    public function test_create_displays_create_form(): void
    {
        $response = $this->get(route('sponsors.create'));
        $response->assertOk();
        $response->assertViewIs('board.sponsors.create');
    }

    #[Test]
    public function test_create_throws_403_when_unauthorized(): void
    {
        $this->actingAs($this->unauthorized);

        $response = $this->get(route('sponsors.create'));

        $response->assertForbidden();
    }

    #[Test]
    public function test_store_creates_sponsor_and_redirects(): void
    {
        Storage::fake('public');

        $data = [
            'name' => 'Acme Corp',
            'tier' => SponsorshipTier::GOLD->value,
            'logo' => UploadedFile::fake()->image('logo.png'),
            'website' => 'www.acme.com',
        ];

        $response = $this->post(route('sponsors.store'), $data);

        $response->assertRedirect(route('sponsors.index'));
        $this->assertDatabaseHas('sponsors', [
            'name' => 'Acme Corp',
            'tier' => SponsorshipTier::GOLD->value,
            'website' => 'www.acme.com',
        ]);
    }

    #[Test]
    public function test_store_throws_403_when_unauthorized(): void
    {
        Storage::fake('public');
        $data = [
            'name' => 'Acme Corp',
            'tier' => SponsorshipTier::GOLD->value,
            'logo' => UploadedFile::fake()->image('logo.png'),
            'website' => 'www.acme.com',
        ];
        $this->actingAs($this->unauthorized);

        $response = $this->post(route('sponsors.store'), $data);

        $response->assertForbidden();
    }

    #[Test]
    public function test_edit_displays_edit_form(): void
    {
        $sponsor = Sponsor::factory()->create();

        $response = $this->get(route('sponsors.edit', $sponsor));
        $response->assertOk();
        $response->assertViewIs('board.sponsors.edit');
        $response->assertViewHas('sponsor');
    }

    #[Test]
    public function test_edit_throws_403_when_unauthorized(): void
    {
        $sponsor = Sponsor::factory()->create();
        $this->actingAs($this->unauthorized);

        $response = $this->get(route('sponsors.edit', $sponsor));

        $response->assertForbidden();
    }

    #[Test]
    public function test_update_modifies_sponsor_data(): void
    {
        Storage::fake('public');
        $sponsor = Sponsor::factory()->create();

        $data = [
            'name' => 'Updated Name',
            'tier' => SponsorshipTier::SILVER->value,
            'logo' => UploadedFile::fake()->image('updated.png'),
            'website' => 'www.updated.com',
        ];

        $response = $this->put(route('sponsors.update', $sponsor), $data);
        $response->assertRedirect(route('sponsors.index'));

        $this->assertDatabaseHas('sponsors', [
            'id' => $sponsor->id,
            'name' => 'Updated Name',
            'tier' => SponsorshipTier::SILVER->value,
            'website' => 'www.updated.com',
        ]);
    }

    #[Test]
    public function test_update_throws_403_when_unauthorized(): void
    {
        Storage::fake('public');
        $sponsor = Sponsor::factory()->create();

        $data = [
            'name' => 'Updated Name',
            'tier' => SponsorshipTier::SILVER->value,
            'logo' => UploadedFile::fake()->image('updated.png'),
            'website' => 'www.updated.com',
        ];

        $this->actingAs($this->unauthorized);

        $response = $this->put(route('sponsors.update', $sponsor), $data);

        $response->assertForbidden();
    }

    #[Test]
    public function test_destroy_deletes_sponsor(): void
    {
        $sponsor = Sponsor::factory()->create();

        $response = $this->delete(route('sponsors.destroy', $sponsor));
        $response->assertRedirect(route('sponsors.index'));

        $this->assertDatabaseMissing('sponsors', [
            'id' => $sponsor->id,
        ]);
    }

    #[Test]
    public function test_destroy_throws_403_when_unauthorized(): void
    {
        $sponsor = Sponsor::factory()->create();
        $this->actingAs($this->unauthorized);

        $response = $this->delete(route('sponsors.destroy', $sponsor));

        $response->assertForbidden();
    }
}
