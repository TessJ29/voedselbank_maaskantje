<?php

use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    public function testAddition()
    {
        // Arrange
        $number1 = 1;
        $number2 = 1;
        $expectedResult = 2;

        // Act
        $result = $number1 + $number2;

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}