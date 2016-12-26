<?php

/**
 * Class Output
 */
class Output
{
    const HR = '**********************************';

    /**
     * @param $message
     */
    public static function message($message)
    {
        self::log($message);
        self::display($message);
    }

    public static function hr()
    {
        self::message(self::HR);
    }

    /**
     * @param $message
     */
    private function log($message)
    {
        date_default_timezone_set('Europe/Rome');
        $file = fopen(sprintf('logs/log_%s.log', date('Y-m-d')), 'a');
        fprintf(
            $file,
            "%s %s \n",
            date('Y-m-d H:i:s'),
            $message
        );
        fclose($file);
    }

    /**
     * @param $message
     */
    private function display($message)
    {
        echo $message . PHP_EOL;
    }
}