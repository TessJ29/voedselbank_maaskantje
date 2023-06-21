<?php
 require 'vendor/autoload.php';

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CoreTest extends TestCase{

    /**
     * @dataProvider getURLProvider
     */

    public function testGetUrl($input, $expected)
    {
        $core = new Core();

        $_GET['url'] = $input;

        $output = $core->getURL();

        $this->assertEquals($expected, $output);
    }

    public static function getURLProvider()
    {
        return [
            [null, array('Landingpages', 'index')],
            ['Contactgegevens/index', array('Contactgegevens', 'index')]
        ];
    }
}