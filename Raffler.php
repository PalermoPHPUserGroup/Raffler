<?php


class Raffler
{

    const WHEEL_ROUNDS = 1500000;
    const WHEEL_PRINT = 259999;
    const NAMES_COUNT = 10;
    const LOSER_WAIT_SCREEN = 2;

    private $competitors = [];

    private $initialCompetitorsCount = 0;

    public function run()
    {
        $this->setInitialCompetitorsCount();

        for ($i = $this->getCompetitorsCount(); $i > 1; $i--) {
            $this->wait();
            $this->printCompetitors();

            for ($j = 0; $j < $this->getRounds(); $j++) {
                $this->shuffleCompetitors($j);
            }

            $this->dismissOneCompetitor();
        }

        $this->printWinner();
    }

    private function setInitialCompetitorsCount()
    {
        $this->initialCompetitorsCount = $this->getCompetitorsCount();
    }

    /**
     * @return int
     */
    public function getCompetitorsCount()
    {
        return count($this->competitors);
    }

    private function printCompetitors()
    {
        Output::message('There are ' . $this->getCompetitorsCount() . ' competitors:');

        sort($this->competitors);

        foreach ($this->competitors AS $competitor) {
            Output::message('- ' . $competitor);
        }

        Output::message('Let\'s turn the wheel...');

    }

    /**
     * @return int
     */
    private function getRounds()
    {
        return self::WHEEL_ROUNDS * (2 - $this->getCompetitorsCount() / $this->initialCompetitorsCount);
    }

    /**
     * @param $j
     */
    private function shuffleCompetitors($j)
    {
        shuffle($this->competitors);

        if ($j % self::WHEEL_PRINT == 0) {
            printf('- Round %\'. 7d: %s%s' . PHP_EOL,
                $j + 1,
                implode(', ', array_slice($this->competitors, 0, self::NAMES_COUNT)),
                $this->getCompetitorsCount() > self::NAMES_COUNT ? ', ...' : ''
            );
        }
    }

    private function dismissOneCompetitor()
    {
        $looser = array_pop($this->competitors);
        $this->printDismissedCompetitor($looser);
    }

    /**
     * @param $name
     */
    private function printDismissedCompetitor($name)
    {
        Output::message('');

        Output::hr();
        Output::message('* I\'m sorry for ' . $name . ' :( ');
        Output::message('* Please try again next time');
        Output::hr();
    }

    /**
     * @param $name
     */
    public function addCompetitor($name)
    {
        $this->competitors[] = $name;
    }

    private function printWinner()
    {
        Output::message('* And the winner is...');
        Output::message('* ' . $this->competitors[0]);
        Output::hr();
    }

    private function wait()
    {
        sleep(self::LOSER_WAIT_SCREEN * (($this->getCompetitorsCount() < 4) ? 2 : 1));
    }
}
