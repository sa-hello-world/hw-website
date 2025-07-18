<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
