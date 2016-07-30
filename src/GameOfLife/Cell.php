<?php

namespace GameOfLife;

class Cell
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @var boolean
     */
    private $alive;

    /**
     * Cell constructor.
     * @param int  $x
     * @param int  $y
     * @param bool $isAlive
     */
    public function __construct($x, $y, $isAlive = false)
    {
        $this->x = $x;
        $this->y = $y;
        $this->alive = $isAlive;
    }

    /**
     * @return boolean
     */
    public function isAlive() : bool
    {
        return $this->alive;
    }

    /**
     * @param boolean $alive
     * @return Cell
     */
    public function setAlive($alive) : self
    {
        $this->alive = $alive;
        return $this;
    }

    /**
     * @param Cells $neighbors
     * @return bool
     */
    public function willBeAlive(Cells $neighbors) : bool
    {
        $aliveCells = $neighbors->countAlive();
        if ($aliveCells === 3) {
            return true;
        }

        if ($this->isAlive() && $aliveCells === 2) {
            return true;
        }

        return false;
    }
}
