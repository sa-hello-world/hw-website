<?php

namespace App\Rules;

use App\Models\SchoolYear;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoAcademicYearOverlap implements ValidationRule
{
    protected $startDate;

    public function __construct($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $start = strtotime($this->startDate);
        $end = strtotime($value);
        $today = strtotime(date('Y-m-d'));

        if ($start < $today) {
            $fail('The start date must be today or a future date.');
            return;
        }

        $currentSchoolYear = SchoolYear::current();

        if ($currentSchoolYear) {
            $currentEnd = strtotime($currentSchoolYear->end_academic_year);
            if ($start <= $currentEnd) {
                $fail("The start date must be after the current school year's end date ({$currentSchoolYear->end_academic_year}).");
                return;
            }
        }

        $futureSchoolYears = SchoolYear::where('start_academic_year', '>', date('Y-m-d'))->get();

        foreach ($futureSchoolYears as $schoolYear) {
            $existingStart = strtotime($schoolYear->start_academic_year);
            $existingEnd = strtotime($schoolYear->end_academic_year);

            if ($start <= $existingEnd && $end >= $existingStart) {
                $fail("The new school year period overlaps with existing future school year ({$schoolYear->start_academic_year} to {$schoolYear->end_academic_year}).");
                return;
            }
        }
    }
}
