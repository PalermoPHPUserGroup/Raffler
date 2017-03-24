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
    public function getCompetitorsCount() : int
    {
        return count($this->competitors);
    }

    private function printCompetitors()
    {
        Output::message();
        Output::message('There are ' . $this->getCompetitorsCount() . ' competitors:');

        sort($this->competitors);

        foreach ($this->competitors as $competitor) {
            Output::message('- ' . $competitor, 'light_cyan');
            $this->wait(.15);
        }

        Output::message('Let\'s turn the wheel...');

    }

    /**
     * @return int
     */
    private function getRounds() : int
    {
        return self::WHEEL_ROUNDS * (2 - $this->getCompetitorsCount() / $this->initialCompetitorsCount);
    }

    /**
     * @param $j
     */
    private function shuffleCompetitors(int $j)
    {
        shuffle($this->competitors);

        if ($j % self::WHEEL_PRINT == 0) {
            Output::message(
                sprintf(
                    '- Round %\'. 7d: %s%s',
                    $j + 1,
                    implode(', ', array_slice($this->competitors, 0, self::NAMES_COUNT)),
                    $this->getCompetitorsCount() > self::NAMES_COUNT ? ', ...' : ''
                ),
                'gray'
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
    private function printDismissedCompetitor(string $name)
    {
        Output::message('');

        Output::hr('red');
        Output::message('* I\'m sorry for ' . $name . ' :( ', 'light_red');
        Output::message('* Please try again next time', 'light_red');
        Output::hr('red');
    }

    /**
     * @param $name
     */
    public function addCompetitor(string $name)
    {
        $this->competitors[] = $name;
    }

    private function printWinner()
    {
        Output::message();
        Output::hr('green');
        Output::message('* And the winner is...', 'green');
        Output::message('* ' . $this->competitors[0], 'green');
        Output::hr('green');
    }

    /**
     * @param float $ratio
     */
    private function wait(float $ratio = 1)
    {
        if (($ratio <= 0) || ($ratio > 1)) {
            throw new DomainException('Invalid ratio');
        }

        usleep(1000000 * $ratio * self::LOSER_WAIT_SCREEN * (($this->getCompetitorsCount() < 4) ? 2 : 1));
    }
}
