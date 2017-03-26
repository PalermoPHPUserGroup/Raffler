<?php

include_once 'Raffler.php';

/**
 * Class RafflerTest
 */
class RafflerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function canInitRaffler()
    {
        $raffler = new Raffler();

        $this->assertInstanceOf(Raffler::class, $raffler);
    }

    /**
     * @test
     */
    public function canAddCompetitors()
    {
        $raffler = new Raffler();
        $raffler->addCompetitor('One');
        $raffler->addCompetitor('Two');

        $this->assertEquals(2, $raffler->getCompetitorsCount());
    }

    /**
     * @test
     */
    public function canRunRaffle()
    {
        $filename = 'logs/log_' . date('Y-m-d') . '.log';
        if (file_exists($filename)) {
            unlink($filename);
        }

        ob_start();
        $raffler = new Raffler();
        $raffler->addCompetitor('One');
        $raffler->addCompetitor('One');
        $raffler->run();
        ob_clean();

        $filename = 'logs/log_' . date('Y-m-d') . '.log';

        $log = file_get_contents($filename);

        $this->assertContains('There are 2 competitors:', $log);
        $this->assertContains('- One', $log);
        $this->assertContains('Let\'s turn the wheel...', $log);
        $this->assertContains('One, One', $log);
        $this->assertContains('I\'m sorry for One :(', $log);
        $this->assertContains('Please try again next time', $log);
        $this->assertContains('And the winner is...', $log);

        $this->assertEquals(1, $raffler->getCompetitorsCount());

        if (file_exists($filename)) {
            unlink($filename);
        }
    }
}
