<?php

/**
 * Class Colors
 */
class Colors
{

    private $foreground_colors = [
        'red'          => '0;31',
        'blue'         => '0;34',
        'cyan'         => '0;36',
        'black'        => '0;30',
        'brown'        => '0;33',
        'green'        => '0;32',
        'white'        => '1;37',
        'purple'       => '0;35',
        'yellow'       => '1;33',
        'dark_gray'    => '1;30',
        'light_red'    => '1;31',
        'light_cyan'   => '1;36',
        'light_blue'   => '1;34',
        'light_gray'   => '0;37',
        'light_green'  => '1;32',
        'light_purple' => '1;35',
    ];

    private $background_colors = [
        'black'      => '40',
        'red'        => '41',
        'green'      => '42',
        'yellow'     => '43',
        'blue'       => '44',
        'magenta'    => '45',
        'cyan'       => '46',
        'light_gray' => '47',
    ];


    /**
     * @param string      $message
     * @param string|null $foregroundColor
     * @param string|null $backgroundColor
     *
     * @return string
     */
    public function getColoredString(
        string $message,
        string $foregroundColor = null,
        string $backgroundColor = null
    ): string {
        $output = '';

        //Check if given foreground color found
        if (isset($this->foreground_colors[$foregroundColor])) {
            $output .= "\033[" . $this->foreground_colors[$foregroundColor] . "m";
        }

        //Check if given background color found
        if (isset($this->background_colors[$backgroundColor])) {
            $output .= "\033[" . $this->background_colors[$backgroundColor] . "m";
        }

        //Add string and end coloring
        $output .= $message . "\033[0m";

        return $output;
    }
}
