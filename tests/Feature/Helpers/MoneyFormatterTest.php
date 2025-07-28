<?php

namespace Tests\Feature\Helpers;

use App\Helpers\MoneyFormatter;
use Money\Money;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MoneyFormatterTest extends TestCase
{
    #[Test]
    public function test_toDecimal_returns_null_when_money_is_null(): void
    {
        $result = MoneyFormatter::toDecimal(null);
        $this->assertNull($result);
    }

    #[Test]
    public function test_toDecimal_formats_money_correctly_for_eur(): void
    {
        $money = Money::EUR(1234);
        $formatted = MoneyFormatter::toDecimal($money);

        $this->assertEquals('12.34', $formatted);
    }

    #[Test]
    public function test_toDecimal_formats_zero_money(): void
    {
        $money = Money::EUR(0);
        $formatted = MoneyFormatter::toDecimal($money);

        $this->assertEquals('0.00', $formatted);
    }

    #[Test]
    public function test_toDecimal_formats_money_with_no_fractional_part(): void
    {
        $money = Money::EUR(1000);
        $formatted = MoneyFormatter::toDecimal($money);

        $this->assertEquals('10.00', $formatted);
    }
}
