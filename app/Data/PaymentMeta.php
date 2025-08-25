<?php

namespace App\Data;

use App\Casts\PaymentMetaCast;
use Illuminate\Contracts\Database\Eloquent\Castable;

class PaymentMeta implements Castable
{
    /**
     * Constructs the payment meta
     * @param int $payable_id
     * @param string $payable_type
     * @param string|null $membership_type
     * @param string|null $semester
     */
    public function __construct(
        public int $payable_id,
        public string $payable_type,
        public ?string $membership_type = null,
        public ?string $semester = null,
    ) {
    }

    /**
     * Casts the meta
     * @param array<string, mixed> $arguments
     * @return string
     */
    public static function castUsing(array $arguments)
    {
        return PaymentMetaCast::class;
    }
}
