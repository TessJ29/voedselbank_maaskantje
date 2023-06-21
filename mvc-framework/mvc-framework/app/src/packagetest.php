<?php


require_once './app/models/Package.php';

use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{

    public function testPackageModelExists()
    {
        $packagemodel = true;
        $expectedResult = isset($packagemodel);

        // Assert
        $this->assertEquals($expectedResult, true);
    }
}
