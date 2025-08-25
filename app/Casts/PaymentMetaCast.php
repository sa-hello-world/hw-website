<?php

namespace App\Casts;

use App\Data\PaymentMeta;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @implements CastsAttributes<?PaymentMeta, ?array>
 */
class PaymentMetaCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array<string, mixed> $attributes
     * @return PaymentMeta|null
     * @throws \JsonException
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?PaymentMeta
    {
        if ($value === null) {
            return null;
        }

        $data = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
        return new PaymentMeta(
            $data['payable_id'],
            $data['payable_type'],
            $data['membership_type'] ?? null,
            $data['semester'] ?? null,
        );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array<string, mixed> $attributes
     * @return string|null
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof PaymentMeta) {
            return json_encode([
                'payable_id'     => $value->payable_id,
                'payable_type'   => $value->payable_type,
                'membership_type'=> $value->membership_type,
                'semester'       => $value->semester,
            ], JSON_THROW_ON_ERROR);
        }

        return json_encode($value, JSON_THROW_ON_ERROR);
    }
}
