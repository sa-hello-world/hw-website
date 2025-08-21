<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\MembershipType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mollie\Laravel\Facades\Mollie;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EventUser> $eventUsers
 * @property-read int|null $event_users_count
 * @property-read mixed $events
 * @property-read mixed $is_member
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Membership> $memberships
 * @property-read int|null $memberships_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
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
     * @return HasMany<EventUser, $this>
     */
    public function eventUsers(): HasMany
    {
        return $this->hasMany(EventUser::class);
    }

    /**
     * Defines the relationship between payment and user
     * @return HasMany<Payment, $this>
     */
    public function payments() : HasMany {
        return $this->hasMany(Payment::class);
    }

    /**
     * Returns the events a user has registered for
     *
     * @return Attribute<Collection<int, Event>, never>
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
     * Returns the associated memberships
     *
     * @return HasMany<Membership, $this>
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
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

    /**
     * Creates a membership entity for the user
     * @param SchoolYear $schoolYear
     * @param Payment $payment
     * @return bool
     */
    public function registerAsMemberForSchoolYear(SchoolYear $schoolYear, Payment $payment): bool
    {
        $membership = Membership::create([
            'user_id' => $this->id,
            'school_year_id' => $schoolYear->id,
            'payment_id' => $payment->id,
        ]);

        if ($payment->meta && $payment->meta->semester) {
            $membership->update(['semester' => $payment->meta->semester]);
        }

        return true;
    }

    /**
     * Returns whether the user is member for the current year
     * TODO: Refactor to be more readable/maintainable
     * @return Attribute<bool,never>
     */
    public function isMember(): Attribute
    {
        return Attribute::make(
            get: function () {
                $schoolYear = SchoolYear::current();

                if (!$schoolYear) {
                    return false;
                }

                $membership = $this->memberships()
                    ->where('school_year_id', $schoolYear->id)
                    ->orderBy('id', 'desc')
                    ->first();

                if (!$membership) {
                    return false;
                } elseif (is_null($membership->semester)) {
                    return true;
                }

                $now = Carbon::now();
                $startOfYear = Carbon::parse($schoolYear->start_academic_year);
                $secondSemester = $schoolYear->start_second_semester;
                $endOfYear = Carbon::parse($schoolYear->end_academic_year);

                return ($membership->semester == 1 && $now->between($startOfYear, $secondSemester)) ||
                    ($membership->semester == 2 && $now->between($secondSemester, $endOfYear));
            }
        );
    }
}
