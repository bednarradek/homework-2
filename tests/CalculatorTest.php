<?php

declare(strict_types=1);

namespace Tests;

use App\Calculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    public function __construct()
    {
        parent::__construct();
        $this->calculator = new Calculator();
    }

    public function testAddTwoNumber(): void
    {
        $excepted = 10.0;
        $actual = $this->calculator->add(5, 5);
        $this->assertEquals($excepted, $actual);
    }

    public function testDivideTwoNumber(): void
    {
        $excepted = 10.0;
        $actual = $this->calculator->divide(20, 2);
        $this->assertSame($excepted, $actual);
    }

    public function testDivideByZeroException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculator->divide(20, 0);
    }
}
