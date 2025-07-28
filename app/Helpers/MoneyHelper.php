<?php

namespace App\Helpers;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
use Money\Parser\DecimalMoneyParser;

class MoneyHelper
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

    /**
     * Parses a string to a money type given currency
     * @param string $amount
     * @param string $currencyCode default "EUR"
     * @return Money|null
     */
    public static function parse(string $amount, string $currencyCode = 'EUR') : ?Money
    {
        $currencies = new ISOCurrencies();
        $moneyParser = new DecimalMoneyParser($currencies);

        return $moneyParser->parse($amount, new Currency($currencyCode));
    }
}
