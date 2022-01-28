<?php declare(strict_types=1);
/**
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2018-2022 Jacques Marneweck.  All rights strictly reserved.
 */

namespace Jacques\Phoenix\Tests\Unit;

use Carbon\Carbon;

final class DateTest extends \PHPUnit\Framework\TestCase
{
    public function testZeroDate(): void
    {
        $result = \Jacques\Phoenix\Date::dateAfterMinOrMin('0000-00-00 00:00:00', '2014-01-01 00:00:00', 'Y-m-d H:i:s');

        $expected = Carbon::createFromFormat('Y-m-d H:i:s', '2014-01-01 00:00:00');
        self::assertEquals($expected, $result);
    }

    public function testJan1970(): void
    {
        $result = \Jacques\Phoenix\Date::dateAfterMinOrMin('1970-01-01 00:00:00', '2014-01-01 00:00:00', 'Y-m-d H:i:s');

        $expected = Carbon::createFromFormat('Y-m-d H:i:s', '2014-01-01 00:00:00');
        self::assertEquals($expected, $result);
    }

    public function testNullDate(): void
    {
        $knownDate = Carbon::create(2019, 3, 1);
        Carbon::setTestNow($knownDate);

        $result = \Jacques\Phoenix\Date::dateAfterMinOrMin(null, '2014-01-01 00:00:00', 'Y-m-d H:i:s');

        $expected = Carbon::createFromFormat('Y-m-d H:i:s', '2019-03-01 00:00:00');
        self::assertEquals($expected, $result);
    }
}
