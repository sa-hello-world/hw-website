<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Money\Currency;
use Money\Money;

class Payment extends Model
{
    protected $fillable = ['user_id', 'amount', 'description', 'status', 'paid_at', 'meta', 'mollie_id'];

    protected $attributes = [
        'status' => PaymentStatus::PENDING
    ];

    protected $casts = [
        'meta' => 'array',
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
     * Type attribute (event/membership)
     * @return Attribute<string|null, string|null>
     */
    protected function payableType(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->meta['payable_type'] ?? null,
            set: fn($value) => [
                'meta' => array_merge($this->meta ?? [], ['payable_type' => $value])
            ]
        );
    }

    /**
     * Payable ID attribute
     * @return Attribute<int|null, int|null>
     */
    protected function payableId(): Attribute
    {
        return Attribute::make(
            get: fn() => isset($this->meta['payable_id'])
                ? (int) $this->meta['payable_id']
                : null,

            set: fn($value) => [
                'meta' => array_merge($this->meta ?? [], [
                    'payable_id' => $value !== null ? (int) $value : null
                ]),
            ]
        );
    }

    /**
     * Membership type attribute (full, semester, early_bird)
     * @return Attribute<string|null, string|null>
     */
    protected function membershipType(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->meta['membership_type'] ?? null,
            set: fn ($value) => [
                'meta' => array_merge($this->meta ?? [], ['membership_type' => $value])
            ]
        );
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
