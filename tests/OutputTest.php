<?php

include_once 'Output.php';

/**
 * Class OutputTest
 */
class OutputTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        ob_start();
    }

    public function tearDown()
    {
        ob_clean();

        $filename = 'logs/log_' . date('Y-m-d') . '.log';
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    /**
     * @test
     */
    public function canOutputAMessage()
    {
        $output = new Output();
        $output->message('Hello', 'green');

        $this->assertEquals("\e[0;32mHello\e[0m" . PHP_EOL, ob_get_flush());
    }

    /**
     * @test
     */
    public function canLogAMessage()
    {
        $output = new Output();
        $output->message('Hello', 'green');

        $filename = 'logs/log_' . date('Y-m-d') . '.log';
        $this->assertFileExists($filename);

        $this->assertEquals(date('Y-m-d H:i:s') . " Hello \n", file_get_contents($filename));
    }

    /**
     * @test
     */
    public function canShowHr()
    {
        $output = new Output();
        $output->hr();

        $this->assertEquals("\e[1;37m**********************************\e[0m" . PHP_EOL, ob_get_flush());
    }
}
