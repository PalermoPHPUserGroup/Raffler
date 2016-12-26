<?php

class Raffler
{
    const WHEEL_ROUNDS = 3500000;
    const WHEEL_PRINT  = 259999;
    const NAMES_COUNT = 10;
    const LOOSER_WAIT_SCREEN = 3;

    private $competitors = [];

    private $initialCompetitorsCount = 0;

    public function run()
    {
        $this->setInitialCompetitorsCount();

        for ($i = $this->getCompetitorsCount(); $i > 1; $i--) {
            $this->printCompetitors();

            for ($j = 0; $j < $this->getRounds(); $j++) {
                $this->shuffleCompetitors($j);
            }

            $this->dismissOneCompetitor();
        }


        echo '***********************************' . PHP_EOL;
        echo 'And the winner is...' . PHP_EOL;
        echo $this->competitors[0] . '!!!!';
    }

    private function printCompetitors()
    {
        echo 'There are ' . $this->getCompetitorsCount() . ' competitors:' . PHP_EOL;

        sort($this->competitors);

        foreach ($this->competitors AS $competitor) {
            echo '- ' . $competitor . PHP_EOL;
        }

        echo 'Let\'s turn the wheel...' . PHP_EOL . PHP_EOL;

    }

    private function dismissOneCompetitor()
    {
        $looser = array_pop($this->competitors);
        echo PHP_EOL . PHP_EOL;
        echo '***********************************' . PHP_EOL;
        echo '* I\'m sorry for ' . $looser . ' :( ' . PHP_EOL;
        echo '* Please try again next time' . PHP_EOL;
        echo '***********************************' . PHP_EOL . PHP_EOL;
        sleep(self::LOOSER_WAIT_SCREEN);
    }

    /**
     * @param $name
     */
    public function addCompetitor($name)
    {
        $this->competitors[] = $name;
    }

    /**
     * @return int
     */
    public function getCompetitorsCount()
    {
        return count($this->competitors);
    }

    private function setInitialCompetitorsCount()
    {
        $this->initialCompetitorsCount = $this->getCompetitorsCount();
    }

    /**
     * @return int
     */
    private function getRounds()
    {
        return self::WHEEL_ROUNDS * (2 - $this->getCompetitorsCount()/$this->initialCompetitorsCount);
    }

    /**
     * @param $j
     */
    private function shuffleCompetitors($j)
    {
        shuffle($this->competitors);

        if ($j % self::WHEEL_PRINT == 0) {
            printf('- Round %d: %s%s' . PHP_EOL,
                $j + 1,
                implode(', ', array_slice($this->competitors, 0, self::NAMES_COUNT)),
                $this->getCompetitorsCount() > self::NAMES_COUNT ? ', ...' : ''
            );
        }
    }


}
