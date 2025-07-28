<?php

namespace App\Rules;

use App\Models\SchoolYear;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoAcademicEndOverlap implements ValidationRule
{
    protected int|null $currentId;

    public function __construct(int|null $currentId = null)
    {
        $this->currentId = $currentId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $end = strtotime($value);

        $futureSchoolYears = SchoolYear::where('start_academic_year', '>', date('Y-m-d'))->get();

        foreach ($futureSchoolYears as $schoolYear) {
            if ($this->currentId && $schoolYear->id == $this->currentId) {
                continue;
            }

            $existingStart = strtotime($schoolYear->start_academic_year);
            $existingEnd = strtotime($schoolYear->end_academic_year);

            if ($end <= $existingEnd && $end >= $existingStart) {
                $fail("The end of the school year overlaps with existing future school year ({$schoolYear->start_academic_year} to {$schoolYear->end_academic_year}).");
                return;
            }
        }
    }
}
