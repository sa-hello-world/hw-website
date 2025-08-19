<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * This model is a linking table between the user and the event.
 * 
 * The model is not to be used directly. Use either Event or User model
 * Will be extended to contain a payment ID
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $payment_id
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\Payment|null $payment
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventUser query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventUser whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventUser wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EventUser whereUserId($value)
 * @mixin \Eloquent
 */
class EventUser extends Model
{
    protected $fillable = ['user_id', 'event_id', 'payment_id'];

    /**
     * Establishes relationship between users and this model (linking table) to events
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Establishes relationship between events and this model (linking table) to users
     * @return BelongsTo<Event, $this>
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Returns the payment it was created with
     *
     * @return BelongsTo
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
