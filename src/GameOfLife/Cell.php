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
     * @var array
     */
    private $neighborPositions = [];

    /**
     * @var boolean
     */
    private $alive;

    /**
     * Cell constructor.
     * @param int   $x
     * @param int   $y
     * @param bool  $isAlive
     * @param array $neighborPositions
     */
    public function __construct($x, $y, bool $isAlive = false, array $neighborPositions = [])
    {
        $this->x = $x;
        $this->y = $y;
        $this->alive = $isAlive;
        $this->neighborPositions = $neighborPositions;
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

    /**
     * @return array
     */
    public function getNeighborPositions() : array
    {
        return $this->neighborPositions;
    }

    /**
     * @param array $neighborPositions
     * @return Cell
     */
    public function setNeighborPositions(array $neighborPositions) : self
    {
        $this->neighborPositions = $neighborPositions;
        return $this;
    }
}
