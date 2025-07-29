<?php

namespace Tests\Feature\Rules;

use App\Models\SchoolYear;
use App\Rules\NoAcademicEndOverlap;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NoAcademicEndOverlapTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_rule_passes_when_no_future_school_years(): void
    {
        $data = ['end_academic_year' => now()->addYear()->format('Y-m-d')];

        $rule = new NoAcademicEndOverlap();

        $validator = Validator::make($data, [
            'end_academic_year' => [$rule],
        ]);

        $this->assertTrue($validator->passes());
    }

    #[Test]
    public function test_rule_fails_if_end_overlaps_with_future_year(): void
    {
        $future = SchoolYear::factory()->create([
            'start_academic_year' => now()->addMonths(2)->format('Y-m-d'),
            'end_academic_year' => now()->addMonths(4)->format('Y-m-d'),
        ]);

        $data = ['end_academic_year' => now()->addMonths(3)->format('Y-m-d')];

        $rule = new NoAcademicEndOverlap();

        $validator = Validator::make($data, [
            'end_academic_year' => [$rule],
        ]);

        $this->assertTrue($validator->fails());
        $this->assertStringContainsString(
            $future->start_academic_year,
            $validator->errors()->first('end_academic_year')
        );
    }

    #[Test]
    public function test_rule_passes_if_end_is_before_all_future_years(): void
    {
        SchoolYear::factory()->create([
            'start_academic_year' => now()->addMonths(3),
            'end_academic_year' => now()->addMonths(6),
        ]);

        $data = ['end_academic_year' => now()->addMonth()->format('Y-m-d')];

        $rule = new NoAcademicEndOverlap();

        $validator = Validator::make($data, [
            'end_academic_year' => [$rule],
        ]);

        $this->assertTrue($validator->passes());
    }

    #[Test]
    public function test_rule_passes_if_end_is_after_all_future_years(): void
    {
        SchoolYear::factory()->create([
            'start_academic_year' => now()->addMonth(),
            'end_academic_year' => now()->addMonths(2),
        ]);

        $data = ['end_academic_year' => now()->addMonths(6)->format('Y-m-d')];

        $rule = new NoAcademicEndOverlap();

        $validator = Validator::make($data, [
            'end_academic_year' => [$rule],
        ]);

        $this->assertTrue($validator->passes());
    }

    #[Test]
    public function test_rule_passes_when_editing_same_school_year(): void
    {
        $schoolYear = SchoolYear::factory()->create([
            'start_academic_year' => now()->addMonth(),
            'end_academic_year' => now()->addMonths(3),
        ]);

        $data = ['end_academic_year' => $schoolYear->end_academic_year];

        $rule = new NoAcademicEndOverlap(currentId: $schoolYear->id);

        $validator = Validator::make($data, [
            'end_academic_year' => [$rule],
        ]);

        $this->assertTrue($validator->passes());
    }
}
