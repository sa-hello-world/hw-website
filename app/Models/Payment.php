<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    protected $fillable = ['user_id', 'amount', 'description', 'status', 'paid_at'];

    /**
     * Defines the relationship between payment and user
     * @return BelongsTo<User, $this>
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Defines the relationship between event user and payment
     * @return HasOne<EventUser, $this>
     */
    public function eventUser() : HasOne
    {
        return $this->hasOne(EventUser::class);
    }

    /**
     * Defines the relationship between membership and payment
     * @return HasOne<Membership, $this>
     */
    public function membership() : HasOne
    {
        return $this->hasOne(Membership::class);
    }
}
