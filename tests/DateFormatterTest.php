<?php

namespace Tests;

use App\DateFormatter;
use DateTime;
use PHPUnit\Framework\TestCase;

class DateFormatterTest extends TestCase
{
    public function testDateFormatterNight(): void
    {
        $except = 'Night';

        $date = new DateTime();
        $date->setTime(2, 0);

        $dateFormatterMock = $this->getMockBuilder(DateFormatter::class)
            ->onlyMethods(['getDateTime'])
            ->getMock();

        $dateFormatterMock
            ->expects($this->any())
            ->method('getDateTime')
            ->will($this->returnValue($date));

        $actual = $dateFormatterMock->getPartOfDay();

        $this->assertEquals($except, $actual);
    }

    public function testDateFormatterMorning(): void
    {
        $except = 'Morning';

        $date = new DateTime();
        $date->setTime(7, 30);

        $dateFormatterMock = $this->getMockBuilder(DateFormatter::class)
            ->onlyMethods(['getDateTime'])
            ->getMock();

        $dateFormatterMock
            ->expects($this->any())
            ->method('getDateTime')
            ->will($this->returnValue($date));

        $actual = $dateFormatterMock->getPartOfDay();

        $this->assertEquals($except, $actual);
    }

    public function testDateFormatterAfternoon(): void
    {
        $except = 'Afternoon';

        $date = new DateTime();
        $date->setTime(12, 30);

        $dateFormatterMock = $this->getMockBuilder(DateFormatter::class)
            ->onlyMethods(['getDateTime'])
            ->getMock();

        $dateFormatterMock
            ->expects($this->any())
            ->method('getDateTime')
            ->will($this->returnValue($date));

        $actual = $dateFormatterMock->getPartOfDay();

        $this->assertEquals($except, $actual);
    }

    public function testDateFormatterEvening(): void
    {
        $except = 'Evening';

        $date = new DateTime();
        $date->setTime(23, 30);

        $dateFormatterMock = $this->getMockBuilder(DateFormatter::class)
            ->onlyMethods(['getDateTime'])
            ->getMock();

        $dateFormatterMock
            ->expects($this->any())
            ->method('getDateTime')
            ->will($this->returnValue($date));

        $actual = $dateFormatterMock->getPartOfDay();

        $this->assertEquals($except, $actual);
    }
}
