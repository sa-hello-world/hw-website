<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $tier
 * @property string|null $logo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SponsorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereLogoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereTier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sponsor extends Model
{
    /** @use HasFactory<\Database\Factories\SponsorFactory> */
    use HasFactory;

    protected $fillable=['name', 'tier', 'logo_path', 'website'];
}
