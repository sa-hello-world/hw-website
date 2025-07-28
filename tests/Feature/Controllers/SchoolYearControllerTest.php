<?php

namespace Tests\Feature\Controllers;

use App\Models\SchoolYear;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Money\Money;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SchoolYearControllerTest extends TestCase
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
    public function test_index_displays_school_years(): void
    {
        SchoolYear::factory()->count(2)->create();

        $response = $this->get(route('school-years.index'));

        $response->assertOk();
        $response->assertViewIs('school-years.index');
        $response->assertViewHas('schoolYears');
    }

    #[Test]
    public function test_index_throws_403_for_unauthorized_user(): void
    {
        $this->actingAs($this->unauthorized);

        $response = $this->get(route('school-years.index'));

        $response->assertForbidden();
    }

    #[Test]
    public function test_create_displays_form(): void
    {
        $response = $this->get(route('school-years.create'));

        $response->assertOk();
        $response->assertViewIs('school-years.create');
    }

    #[Test]
    public function test_create_throws_403_for_unauthorized_user(): void
    {
        $this->actingAs($this->unauthorized);

        $response = $this->get(route('school-years.create'));

        $response->assertForbidden();
    }

    #[Test]
    public function test_store_creates_school_year_and_redirects(): void
    {
        $data = [
            'start_academic_year' => now()->addMonth()->startOfMonth()->toDateString(),
            'end_academic_year' => now()->addMonths(12)->endOfMonth()->toDateString(),
            'name_of_chairman' => 'Jane Smith',
            'regular_membership_price' => 10.00,
            'early_membership_price' => 8.00,
            'semester_membership_price' => 5.00,
        ];

        $response = $this->post(route('school-years.store'), $data);

        $response->assertRedirect(route('school-years.index'));
        $this->assertDatabaseHas('school_years', [
            'name_of_chairman' => 'Jane Smith',
        ]);
    }

    #[Test]
    public function test_store_fails_validation_and_returns_errors(): void
    {
        $data = [
            'start_academic_year' => now()->subYear()->toDateString(),
            'end_academic_year' => 'invalid-date',
            'name_of_chairman' => 'J',
            'regular_membership_price' => -100,
        ];

        $response = $this->post(route('school-years.store'), $data);

        $response->assertSessionHasErrors([
            'start_academic_year',
            'end_academic_year',
            'name_of_chairman',
            'regular_membership_price',
        ]);
    }

    #[Test]
    public function test_edit_displays_form(): void
    {
        $schoolYear = SchoolYear::factory()->create();

        $response = $this->get(route('school-years.edit', $schoolYear));

        $response->assertOk();
        $response->assertViewIs('school-years.edit');
        $response->assertViewHas('schoolYear', $schoolYear);
    }

    #[Test]
    public function test_edit_throws_403_for_unauthorized_user(): void
    {
        $schoolYear = SchoolYear::factory()->create();

        $this->actingAs($this->unauthorized);

        $response = $this->get(route('school-years.edit', $schoolYear));

        $response->assertForbidden();
    }

    #[Test]
    public function test_update_modifies_school_year_and_redirects(): void
    {
        $schoolYear = SchoolYear::factory()->create([
            'name_of_chairman' => 'Old Name',
            'regular_membership_price' => Money::EUR(1000),
        ]);

        $data = [
            'start_academic_year' => $schoolYear->start_academic_year,
            'end_academic_year' => $schoolYear->end_academic_year,
            'name_of_chairman' => 'New Chair',
            'regular_membership_price' => 12.34,
            'early_membership_price' => 8.00,
            'semester_membership_price' => 4.00,
        ];

        $response = $this->put(route('school-years.update', $schoolYear), $data);

        $response->assertRedirect(route('school-years.index'));
        $this->assertDatabaseHas('school_years', [
            'id' => $schoolYear->id,
            'regular_membership_price' => 1234,
            'name_of_chairman' => 'New Chair',
        ]);
    }

    #[Test]
    public function test_update_fails_validation(): void
    {
        $schoolYear = SchoolYear::factory()->create();

        $data = [
            'start_academic_year' => 'not-a-date',
            'end_academic_year' => 'invalid',
            'name_of_chairman' => 'J',
            'regular_membership_price' => -20,
        ];

        $response = $this->put(route('school-years.update', $schoolYear), $data);

        $response->assertSessionHasErrors([
            'start_academic_year',
            'end_academic_year',
            'name_of_chairman',
            'regular_membership_price',
        ]);
    }

    #[Test]
    public function test_update_throws_403_for_unauthorized_user(): void
    {
        $schoolYear = SchoolYear::factory()->create();

        $this->actingAs($this->unauthorized);

        $response = $this->put(route('school-years.update', $schoolYear), []);

        $response->assertForbidden();
    }

    #[Test]
    public function test_destroy_deletes_school_year(): void
    {
        $schoolYear = SchoolYear::factory()->create();

        $response = $this->delete(route('school-years.destroy', $schoolYear));

        $response->assertRedirect(route('school-years.index'));
        $this->assertDatabaseMissing('school_years', ['id' => $schoolYear->id]);
    }

    #[Test]
    public function test_destroy_throws_403_for_unauthorized_user(): void
    {
        $schoolYear = SchoolYear::factory()->create();

        $this->actingAs($this->unauthorized);

        $response = $this->delete(route('school-years.destroy', $schoolYear));

        $response->assertForbidden();
    }
}
