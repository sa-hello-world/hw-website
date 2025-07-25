<?php

namespace App\Models;

use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $poster_path
 * @property int|null $available_places
 * @property string $start
 * @property string|null $end
 * @property int|null $regular_price
 * @property int|null $member_price
 * @property string $type
 * @property string|null $open_for
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EventUser> $eventUsers
 * @property-read int|null $event_users_count
 * @property-read mixed $users
 * @method static \Database\Factories\EventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereAvailablePlaces($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereMemberPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereOpenFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event wherePosterPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereRegularPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Event whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'poster_path', 'available_places', 'start', 'end',
        'regular_price', 'membership_price', 'type', 'open_for'];

    /**
     * Please do not use this method; it's just hiding away the connection
     * @return HasMany<EventUser, $this>
     */
    public function eventUsers(): HasMany
    {
        return $this->hasMany(EventUser::class);
    }

    /**
     * Returns the users that registered for the event
     *
     * @return Attribute<Collection<int, User>, never>
     */
    public function users(): Attribute
    {
        return Attribute::make(
            get: fn() => User::whereHas('eventUsers', function ($query) {
                $query->where('event_id', $this->id);
            })->get(),
        );
    }
}
