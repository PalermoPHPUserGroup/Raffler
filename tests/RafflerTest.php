<?php

include_once '../Raffler.php';

class RafflerTest extends PHPUnit_Framework_TestCase
{

    public function testCanInitRaffler()
    {
        $raffler = new Raffler();

        $this->assertInstanceOf(Raffler::class, $raffler);
    }

    public function testCanAddCompetitors()
    {
        $raffler = new Raffler();
        $raffler->addCompetitor('One');
        $raffler->addCompetitor('Two');

        $this->assertEquals(2, $raffler->getCompetitorsCount());
    }
}
