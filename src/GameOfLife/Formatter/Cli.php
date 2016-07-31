<?php


namespace GameOfLife\Formatter;


class Cli
{
    public function format(array $world) : string
    {
        $formattedString = '';
        foreach ($world as $y => $row) {
            if ($y !== 0) {
                $formattedString .= PHP_EOL;
            }
            /**
             * @var int $x
             * @var \GameOfLife\Cell $cell
             */
            foreach ($row as $x => $cell) {
                if ($x !== 0) {
                    $formattedString .= ' ';
                }
                $formattedString .= $cell->isAlive() ? '•' : ' ';
            }
        }
        return $formattedString;
    }
}