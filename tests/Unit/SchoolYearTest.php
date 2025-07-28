<?php

namespace Tests\Unit;

use App\Models\SchoolYear;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Money\Money;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SchoolYearTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(Carbon::parse('2025-08-01'));
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Carbon::setTestNow();
    }

    #[Test]
    public function test_current_returns_null_if_no_matching_year(): void
    {
        $this->assertNull(SchoolYear::current());
    }

    #[Test]
    public function test_current_returns_the_correct_school_year(): void
    {
        $today = now();

        $year = SchoolYear::factory()->create([
            'start_academic_year' => $today->copy()->subMonth(),
            'end_academic_year' => $today->copy()->addMonth(),
        ]);

        $currentSchoolYear = SchoolYear::current();

        $this->assertNotNull($currentSchoolYear);
        $this->assertTrue($currentSchoolYear->is($year));
    }


    #[Test]
    public function test_available_returns_school_years_starting_from_current_or_today(): void
    {
        $past = SchoolYear::factory()->create([
            'start_academic_year' => now()->copy()->subYears(2),
            'end_academic_year' => now()->copy()->subYear(),
        ]);

        $current = SchoolYear::factory()->create([
            'start_academic_year' => now()->copy()->subMonth(),
            'end_academic_year' => now()->copy()->addMonth(),
        ]);

        $future = SchoolYear::factory()->create([
            'start_academic_year' => now()->copy()->addMonth(),
            'end_academic_year' => now()->copy()->addMonths(6),
        ]);

        $available = SchoolYear::available();

        $this->assertFalse($available->contains($past));
        $this->assertTrue($available->contains($current));
        $this->assertTrue($available->contains($future));
    }

    #[Test]
    public function test_previous_returns_only_years_before_current(): void
    {
        $past1 = SchoolYear::factory()->create([
            'start_academic_year' => now()->copy()->subYears(3),
            'end_academic_year' => now()->copy()->subYears(2),
        ]);

        $past2 = SchoolYear::factory()->create([
            'start_academic_year' => now()->copy()->subYears(2),
            'end_academic_year' => now()->copy()->subYear(),
        ]);

        $current = SchoolYear::factory()->create([
            'start_academic_year' => now()->copy()->subMonth(),
            'end_academic_year' => now()->copy()->addMonth(),
        ]);

        $previous = SchoolYear::previous();

        $this->assertTrue($previous->contains($past1));
        $this->assertTrue($previous->contains($past2));
        $this->assertFalse($previous->contains($current));
    }

    #[Test]
    public function test_years_returns_correct_format(): void
    {
        $year = SchoolYear::factory()->create([
            'start_academic_year' => '2024-09-01',
            'end_academic_year' => '2025-06-30',
        ]);

        $this->assertEquals('2024 - 2025', $year->years);
    }

    #[Test]
    public function test_regular_membership_price_casts_to_money_and_back(): void
    {
        $money = Money::EUR(1000);

        $year = SchoolYear::factory()->create([
            'regular_membership_price' => $money,
        ]);

        $this->assertEquals($money, $year->regular_membership_price);

        /** @phpstan-ignore-next-line PHPStan does not detect it, but it is cast - check docs in SchoolYear Model */
        $year->regular_membership_price = Money::EUR(2500);
        $year->save();

        $this->assertDatabaseHas('school_years', [
            'id' => $year->id,
            'regular_membership_price' => 2500,
        ]);
    }

    #[Test]
    public function test_early_membership_price_handles_null_and_cast(): void
    {
        $year = SchoolYear::factory()->create([
            'early_membership_price' => null,
        ]);

        /** @phpstan-ignore-next-line PHPStan does not detect it, but the attr returns null if no value */
        $this->assertNull($year->early_membership_price);

        $money = Money::EUR(1500);
        /** @phpstan-ignore-next-line PHPStan does not detect it, but it is cast - check docs in SchoolYear Model */
        $year->early_membership_price = $money;
        $year->save();

        $this->assertDatabaseHas('school_years', [
            'id' => $year->id,
            'early_membership_price' => 1500,
        ]);

        /** @phpstan-ignore-next-line year was literally created above */
        $this->assertEquals($money, $year->fresh()->early_membership_price);
    }

    #[Test]
    public function test_semester_membership_price_handles_null_and_cast(): void
    {
        $year = SchoolYear::factory()->create([
            'semester_membership_price' => null,
        ]);

        /** @phpstan-ignore-next-line PHPStan does not detect it, but the attr returns null if no value */
        $this->assertNull($year->semester_membership_price);

        $money = Money::EUR(1100);
        /** @phpstan-ignore-next-line PHPStan does not detect it, but it is cast - check docs in SchoolYear Model */
        $year->semester_membership_price = $money;
        $year->save();

        $this->assertDatabaseHas('school_years', [
            'id' => $year->id,
            'semester_membership_price' => 1100,
        ]);

        /** @phpstan-ignore-next-line year was literally created above */
        $this->assertEquals($money, $year->fresh()->semester_membership_price);
    }
}
