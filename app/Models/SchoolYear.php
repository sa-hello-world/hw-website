<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $fillable = ['start_academic_year', 'end_academic_year', 'name_of_chairman', 'regular_membership_price',
        'early_membership_price', 'semester_membership_price'];
}
