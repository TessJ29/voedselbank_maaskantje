<?php
 require 'vendor/autoload.php';

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

 class LandingpagesTest extends TestCase
 {

    #[DataProvider('addProvider')]
    public function testAdd($number1, $number2, $expected)
    {
        $landingpages = new Landingpages();

        $output = $landingpages->add($number1, $number2);

        $this->assertEquals($expected, $output);
    }

    // Dit is een dataprovider
    public static function addProvider(){
        return [
            [5, 5, 10],
            [-1, 3 , 2]
        ];
    }
 }
