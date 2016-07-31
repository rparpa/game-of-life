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
     * @param bool|null  $isAlive
     * @param array $neighborPositions
     */
    public function __construct($x, $y, bool $isAlive = null, array $neighborPositions = [])
    {
        $this->x = $x;
        $this->y = $y;
        $this->alive = $isAlive === null ? mt_rand(0, 1) === 1 : $isAlive;
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
        return $aliveCells === 3 || ($this->alive && $aliveCells === 2);
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
