<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $start_academic_year
 * @property string $end_academic_year
 * @property string|null $name_of_chairman
 * @property int $regular_membership_price
 * @property int|null $early_membership_price
 * @property int|null $semester_membership_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Event> $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Membership> $memberships
 * @property-read int|null $memberships_count
 * @property-read mixed $years
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereEarlyMembershipPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereEndAcademicYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereNameOfChairman($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereRegularMembershipPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereSemesterMembershipPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereStartAcademicYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SchoolYear whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SchoolYear extends Model
{
    protected $fillable = ['start_academic_year', 'end_academic_year', 'name_of_chairman', 'regular_membership_price',
        'early_membership_price', 'semester_membership_price'];

    /**
     * Returns the memberships created through the season
     *
     * @return HasMany<Membership, $this>
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }

    /**
     * Returns the events created through the season
     *
     * @return HasMany<Event, $this>
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Returns the current academic year if such exist
     * @return SchoolYear|null
     */
    public static function current(): ?SchoolYear
    {
        $today = now()->startOfDay();

        return self::whereDate('start_academic_year', '<=', $today)
            ->whereDate('end_academic_year', '>=', $today)
            ->first();
    }

    /**
     * Returns the available school years in which you can add an event
     * @return Collection<int, SchoolYear>
     */
    public static function available(): Collection
    {
        $start = SchoolYear::current()->start_academic_year ?? now()->startOfDay();

        return self::whereDate('start_academic_year', '>=', $start)
            ->get();
    }

    /**
     * Returns the previous academic year if such exist
     * @return SchoolYear|null
     */
    public static function previous(): ?SchoolYear
    {
        return self::whereDate('start_academic_year', '<', (optional(SchoolYear::current())->start_academic_year ?? now()->startOfDay()))
            ->orderByDesc('start_academic_year')
            ->first();
    }

    /**
     * Simply returns the years it spans through
     * E.g. 2024-2025
     * @return Attribute<string, never>
     */
    public function years(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->start_academic_year)->format('Y')
                . ' - '
                . Carbon::parse($this->end_academic_year)->format('Y')
        );
    }
}
