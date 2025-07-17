<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * This model is a linking table between the user and the event.
 * The model is not to be used directly. Use either Event or User model
 * Will be extended to contain a payment ID
 */
class EventUser extends Model
{
    protected $fillable = ['user_id', 'event_id'];

    /**
     * Establishes relationship between users and this model (linking table) to events
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Establishes relationship between events and this model (linking table) to users
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }}
