<?php

/**
 * Class Output
 */
class Output
{
    const HR = '**********************************';

    /**
     * @param string $message
     * @param string $color
     */
    public static function message(string $message = '', string $color = 'white')
    {
        self::log($message);
        self::display($message, $color);
    }

    /**
     * @param string $color
     */
    public static function hr(string $color = 'white')
    {
        self::message(self::HR, $color);
    }

    /**
     * @param $message
     */
    private static function log(string $message)
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
     * @param        $message
     * @param string $color
     */
    private static function display(string $message = '', string $color = 'white')
    {
        $colors = new Colors();

        echo $colors->getColoredString($message, $color) . PHP_EOL;
    }
}
