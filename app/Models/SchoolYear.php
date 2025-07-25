<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Membership> $memberships
 * @property-read int|null $memberships_count
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
}
