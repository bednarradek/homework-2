<?php

namespace Tests;

use App\DateFormatter;
use DateTime;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DateFormatterTest extends TestCase
{
    /** @var DateFormatter&MockObject  */
    private mixed $dateFormatterMock;

    protected function setUp(): void
    {
        $this->dateFormatterMock = $this->getMockBuilder(DateFormatter::class)
            ->onlyMethods(['getDateTime'])
            ->getMock();
    }

    protected function setReturnValueForDateFormatter(int $hours, int $minutes): void
    {
        $date = new DateTime();
        $date->setTime($hours, $minutes);

        $this->dateFormatterMock
            ->expects($this->any())
            ->method('getDateTime')
            ->will($this->returnValue($date));
    }

    public function testDateFormatterNight(): void
    {
        $except = 'Night';
        $this->setReturnValueForDateFormatter(2, 0);
        $actual = $this->dateFormatterMock->getPartOfDay();
        $this->assertEquals($except, $actual);
    }

    public function testDateFormatterMorning(): void
    {
        $except = 'Morning';
        $this->setReturnValueForDateFormatter(7, 30);
        $actual = $this->dateFormatterMock->getPartOfDay();
        $this->assertEquals($except, $actual);
    }

    public function testDateFormatterAfternoon(): void
    {
        $except = 'Afternoon';
        $this->setReturnValueForDateFormatter(12, 00);
        $actual = $this->dateFormatterMock->getPartOfDay();
        $this->assertEquals($except, $actual);
    }

    public function testDateFormatterEvening(): void
    {
        $except = 'Evening';
        $this->setReturnValueForDateFormatter(23, 30);
        $actual = $this->dateFormatterMock->getPartOfDay();
        $this->assertEquals($except, $actual);
    }
}
