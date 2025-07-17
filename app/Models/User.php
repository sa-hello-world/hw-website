<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Please do not use this method; it's just hiding away the connection
     * @return HasMany
     */
    public function eventUsers(): HasMany {
        return $this->hasMany(EventUser::class);
    }

    /**
     * Returns the events a user has registered for
     *
     * @return Attribute<Collection, never>
     */
    public function events(): Attribute
    {
        return Attribute::make(
            get: fn() => Event::whereHas('eventUsers', function ($query) {
                $query->where('user_id', $this->id);
            })->get(),
        );
    }

    /**
     * Helper function that registers a user for event
     * TODO: expand when payment comes in
     * @param Event $event
     * @return bool
     */
    public function registerForEvent(Event $event): bool
    {
        if ($this->events->contains($event)) {
            return false;
        }

        EventUser::create(['user_id' => $this->id, 'event_id' => $event->id]);

        return true;
    }
}
