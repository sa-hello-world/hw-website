<?php

namespace App\Helpers;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

class MoneyFormatter
{
    /**
     * Parses the Money type to a decimal in a string form
     * @param Money|null $money
     * @return string|null
     */
    public static function toDecimal(?Money $money): ?string
    {
        if (!$money) {
            return null;
        }

        $subunit = ISOCurrencies::class;
        $currencies = new $subunit();
        $formatter = new DecimalMoneyFormatter($currencies);

        return $formatter->format($money);
    }

}
