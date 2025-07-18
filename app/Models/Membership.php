<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * TODO: Expand with the payments when Mollie gets implemented
 */
class Membership extends Model
{
    protected $fillable = ['user_id', 'school_year_id'];
}
