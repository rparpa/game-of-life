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
    public function __construct($x, $y, bool $isAlive = false)
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
     * @param bool $alive
     * @return Cell
     */
    public function setAlive(bool $alive) : self
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

    /**
     * @return int
     */
    public function getX() : int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY() : int
    {
        return $this->y;
    }
}
