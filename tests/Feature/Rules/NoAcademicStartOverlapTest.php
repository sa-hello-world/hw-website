<?php

namespace Tests\Feature\Rules;

use App\Models\SchoolYear;
use App\Rules\NoAcademicStartOverlap;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NoAcademicStartOverlapTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_rule_passes_when_no_current_or_future_school_year(): void
    {
        $data = ['start_academic_year' => now()->format('Y-m-d')];

        $rule = new NoAcademicStartOverlap();

        $validator = Validator::make($data, [
            'start_academic_year' => [$rule],
        ]);

        $this->assertTrue($validator->passes());
    }

    #[Test]
    public function test_rule_fails_if_start_is_within_current_year(): void
    {
        $current = SchoolYear::factory()->create([
            'start_academic_year' => now()->subMonth()->format('Y-m-d'),
            'end_academic_year' => now()->addMonth()->format('Y-m-d'),
        ]);

        $data = ['start_academic_year' => now()->format('Y-m-d')];

        $rule = new NoAcademicStartOverlap();

        $validator = Validator::make($data, [
            'start_academic_year' => [$rule],
        ]);

        $this->assertTrue($validator->fails());
        $this->assertStringContainsString(
            $current->end_academic_year,
            $validator->errors()->first('start_academic_year')
        );
    }

    #[Test]
    public function test_rule_passes_when_editing_the_same_school_year(): void
    {
        $current = SchoolYear::factory()->create([
            'start_academic_year' => now()->subMonth(),
            'end_academic_year' => now()->addMonth(),
        ]);

        $data = ['start_academic_year' => now()->format('Y-m-d')];

        $rule = new NoAcademicStartOverlap(currentId: $current->id);

        $validator = Validator::make($data, [
            'start_academic_year' => [$rule],
        ]);

        $this->assertTrue($validator->passes());
    }

    #[Test]
    public function test_rule_fails_if_start_overlaps_with_future_year(): void
    {
        $future = SchoolYear::factory()->create([
            'start_academic_year' => now()->addMonth()->format('Y-m-d'),
            'end_academic_year' => now()->addMonths(3)->format('Y-m-d'),
        ]);

        $data = ['start_academic_year' => now()->addMonth()->addDays(5)->format('Y-m-d')];

        $rule = new NoAcademicStartOverlap();

        $validator = Validator::make($data, [
            'start_academic_year' => [$rule],
        ]);

        $this->assertTrue($validator->fails());
        $this->assertStringContainsString(
            $future->start_academic_year,
            $validator->errors()->first('start_academic_year')
        );
    }

    #[Test]
    public function test_rule_passes_when_start_does_not_overlap_anything(): void
    {
        SchoolYear::factory()->create([
            'start_academic_year' => now()->subYears(2),
            'end_academic_year' => now()->subYear(),
        ]);

        SchoolYear::factory()->create([
            'start_academic_year' => now()->addMonth(),
            'end_academic_year' => now()->addMonths(3),
        ]);

        $data = ['start_academic_year' => now()->addMonths(6)->format('Y-m-d')];

        $rule = new NoAcademicStartOverlap();

        $validator = Validator::make($data, [
            'start_academic_year' => [$rule],
        ]);

        $this->assertTrue($validator->passes());
    }
}
