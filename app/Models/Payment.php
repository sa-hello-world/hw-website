<?php

namespace App\Models;

use App\Data\PaymentMeta;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Money\Currency;
use Money\Money;

/**
 * @property int $id
 * @property int $user_id
 * @property Money $amount
 * @property string $description
 * @property string $status
 * @property string|null $paid_at
 * @property \App\Data\PaymentMeta|null $meta
 * @property string|null $mollie_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EventUser|null $eventUser
 * @property-read \App\Models\Membership|null $membership
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereMollieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereUserId($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    protected $fillable = ['user_id', 'amount', 'description', 'status', 'paid_at', 'meta', 'mollie_id'];

    protected $attributes = [
        'status' => PaymentStatus::PENDING
    ];

    protected $casts = [
        'meta' => PaymentMeta::class,
    ];

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

    /**
     * Casts the integer values from the db into money type and vice versa
     * for the amount of the payment
     * @return Attribute<Money, string>
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => new Money($value, new Currency('EUR')),
            set: fn (Money $money) => $money->getAmount()
        );
    }
}
