<?php

namespace App\Models;

use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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
