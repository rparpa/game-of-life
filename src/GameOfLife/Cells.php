<?php


namespace GameOfLife;

class Cells
{
    /**
     * @var Cell[]
     */
    private $cells;

    public function __construct(array $cells)
    {
        $this->cells = $cells;
    }

    /**
     * @return int
     */
    public function countAlive() : int
    {
        if (count($this->cells) === 0) {
            return 0;
        }

        return array_reduce(
            $this->cells,
            function ($carry, Cell $cell) {
                return $carry + (bool) $cell->isAlive();
            }
        );
    }
}
