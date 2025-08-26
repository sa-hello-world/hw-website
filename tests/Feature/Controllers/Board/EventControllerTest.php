<?php

namespace Feature\Controllers\Board;

use App\Enums\EventType;
use App\Models\Event;
use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Money\Money;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $chair;
    private User $unauthorized;
    private SchoolYear $schoolYear;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('app:sync-permissions');

        $this->unauthorized = User::factory()->create();
        $this->chair = User::factory()->create();
        $this->chair->assignRole('chairman');
        $this->actingAs($this->chair);

        $this->schoolYear = SchoolYear::create([
            'start_academic_year' => now()->subMonths(1)->startOfMonth(),
            'end_academic_year' => now()->addMonths(11)->endOfMonth(),
            'name_of_chairman' => 'John Doe',
            'regular_membership_price' => Money::EUR(2000),
            'early_membership_price' => Money::EUR(1000),
            'semester_membership_price' => Money::EUR(1000),
        ]);
    }

    #[Test]
    public function test_index_displays_events(): void
    {
        $this->schoolYear->events()->createMany(
            Event::factory()->count(3)->make()->toArray()
        );

        $response = $this->get(route('events.index'));

        $response->assertOk();
        $response->assertViewHas('currentSchoolYear');
        $response->assertViewHas('currentSchoolYearEvents');
        $response->assertViewHas('currentSchoolYearEventsCount');
        $response->assertViewHas('previousSchoolYearEvents');
    }

    #[Test]
    public function test_index_throws_403_when_unauthorized(): void
    {
        $this->actingAs($this->unauthorized);

        $response = $this->get(route('events.index'));

        $response->assertForbidden();
    }

    #[Test]
    public function test_create_displays_create_form(): void
    {
        $response = $this->get(route('events.create'));

        $response->assertOk();
        $response->assertViewIs('board.events.create');
    }

    #[Test]
    public function test_store_creates_event_and_redirects(): void
    {
        Storage::fake('public');

        $data = [
            'name' => 'Sample Event',
            'description' => 'This is a test event.',
            'location' => 'Main Hall',
            'poster' => UploadedFile::fake()->image('poster.png'),
            'banner' => UploadedFile::fake()->image('banner.png'),
            'available_places' => 100,
            'start' => now()->addDays(1)->toDateString(),
            'end' => now()->addDays(2)->toDateString(),
            'regular_price' => 50.00,
            'member_price' => 25.00,
            'type' => EventType::WORKSHOP->value,
            'open_for' => 'Members only',
            'school_year_id' => $this->schoolYear->id,
        ];

        $response = $this->post(route('events.store'), $data);

        $response->assertRedirect(route('events.index'));
        $this->assertDatabaseHas('events', [
            'name' => 'Sample Event',
            'location' => 'Main Hall',
            'type' => EventType::WORKSHOP->value,
        ]);
    }

    #[Test]
    public function test_store_throws_403_when_unauthorized(): void
    {
        Storage::fake('public');

        $data = [
            'name' => 'Sample Event',
            'description' => 'This is a test event.',
            'location' => 'Main Hall',
            'poster' => UploadedFile::fake()->image('poster.png'),
            'banner' => UploadedFile::fake()->image('banner.png'),
            'available_places' => 100,
            'start' => now()->addDays(1)->toDateString(),
            'end' => now()->addDays(2)->toDateString(),
            'regular_price' => 50.00,
            'member_price' => 25.00,
            'type' => EventType::WORKSHOP->value,
            'open_for' => 'Members only',
            'school_year_id' => $this->schoolYear->id,
        ];

        $this->actingAs($this->unauthorized);

        $response = $this->post(route('events.store'), $data);

        $response->assertForbidden();
    }

    #[Test]
    public function test_store_fails_validation_and_returns_errors(): void
    {
        $data = [
            'type' => 'invalid-type',
            'school_year_id' => 9999,
        ];

        $response = $this->post(route('events.store'), $data);

        $response->assertSessionHasErrors([
            'name',
            'description',
            'location',
            'start',
            'type',
            'school_year_id',
        ]);
    }


    #[Test]
    public function test_edit_displays_edit_form_when_event_is_upcoming(): void
    {
        $event = Event::factory()->create(['start' => now()->addDay()]);

        $response = $this->get(route('events.edit', $event));

        $response->assertOk();
        $response->assertViewIs('board.events.edit');
        $response->assertViewHas('event');
    }

    #[Test]
    public function test_edit_throws_403_when_event_is_in_the_past(): void
    {
        $event = Event::factory()->create(['start' => now()->subDay()]);

        $response = $this->get(route('events.edit', $event));

        $response->assertForbidden();
    }

    #[Test]
    public function test_edit_throws_403_when_unauthorized(): void
    {
        $event = Event::factory()->create();

        $this->actingAs($this->unauthorized);

        $response = $this->get(route('events.edit', $event));

        $response->assertForbidden();
    }

    #[Test]
    public function test_update_modifies_event_data(): void
    {
        Storage::fake('public');

        $event = Event::factory()->create(['start' => now()->addDay()]);

        $data = [
            'name' => 'Updated Event',
            'description' => 'Updated description.',
            'location' => 'New Location',
            'poster' => UploadedFile::fake()->image('poster-updated.png'),
            'banner' => UploadedFile::fake()->image('banner-updated.png'),
            'available_places' => 50,
            'start' => now()->addDays(5)->toDateString(),
            'end' => now()->addDays(6)->toDateString(),
            'regular_price' => 80.00,
            'member_price' => 60.00,
            'type' => EventType::WAITT->value,
            'open_for' => 'All students',
            'school_year_id' => $this->schoolYear->id,
        ];

        $response = $this->put(route('events.update', $event), $data);

        $response->assertRedirect(route('events.index'));
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'name' => 'Updated Event',
            'location' => 'New Location',
            'type' => EventType::WAITT->value,
        ]);
    }

    #[Test]
    public function test_update_throws_403_when_unauthorized(): void
    {
        Storage::fake('public');

        $event = Event::factory()->create(['start' => now()->addDay()]);

        $data = [
            'name' => 'Updated Event',
            'description' => 'Updated description.',
            'location' => 'New Location',
            'poster' => UploadedFile::fake()->image('poster-updated.png'),
            'banner' => UploadedFile::fake()->image('banner-updated.png'),
            'available_places' => 50,
            'start' => now()->addDays(5)->toDateString(),
            'end' => now()->addDays(6)->toDateString(),
            'regular_price' => 80.00,
            'member_price' => 60.00,
            'type' => EventType::HACKATHON->value,
            'open_for' => 'All students',
            'school_year_id' => $this->schoolYear->id,
        ];

        $this->actingAs($this->unauthorized);

        $response = $this->put(route('events.update', $event), $data);

        $response->assertForbidden();
    }

    #[Test]
    public function test_update_fails_validation_and_returns_errors(): void
    {
        $event = Event::factory()->create(['start' => now()->addDay()]);

        $data = [
            'name' => '',
            'description' => '',
            'location' => '',
            'start' => 'not-a-date',
            'type' => 'invalid-type',
            'school_year_id' => 9999,
        ];

        $response = $this->put(route('events.update', $event), $data);

        $response->assertSessionHasErrors([
            'name',
            'description',
            'location',
            'start',
            'type',
            'school_year_id',
        ]);
    }


    #[Test]
    public function test_destroy_deletes_event(): void
    {
        $event = Event::factory()->create();

        $response = $this->delete(route('events.destroy', $event));

        $response->assertRedirect(route('events.index'));
        $this->assertDatabaseMissing('events', [
            'id' => $event->id,
        ]);
    }

    #[Test]
    public function test_destroy_throws_403_when_unauthorized(): void
    {
        $event = Event::factory()->create();

        $this->actingAs($this->unauthorized);

        $response = $this->delete(route('events.destroy', $event));

        $response->assertForbidden();
    }
}
