<?php

include_once 'Colors.php';

/**
 * Class ColorsTest
 */
class ColorsTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function getANormalString()
    {
        $colors = new Colors();
        $this->assertEquals("Hello\033[0m", $colors->getColoredString('Hello'));
    }

    /**
     * @test
     */
    public function getForegroundColoredString()
    {
        $colors = new Colors();
        $this->assertEquals("\033[0;32mHello\033[0m", $colors->getColoredString('Hello', 'green'));
    }

    /**
     * @test
     */
    public function getBackgroundColoredString()
    {
        $colors = new Colors();
        $this->assertEquals("\033[43mHello\033[0m", $colors->getColoredString('Hello', null, 'yellow'));
    }

    /**
     * @test
     */
    public function getForegroundAndBackgroundColoredString()
    {
        $colors = new Colors();
        $this->assertEquals("\033[0;32m\033[43mHello\033[0m", $colors->getColoredString('Hello', 'green', 'yellow'));
    }

}
