<?php

namespace GameOfLife;

class WorldFactory
{
    /**
     * @param array $neighborPositions
     * @param array $world
     * @return Cell[]
     */
    private function getNeighbors(array $neighborPositions, array $world) : array
    {
        $neighbors = [];
        foreach ($neighborPositions as $position) {
            $neighbors[] = $world[$position[1]][$position[0]];
        }
        return $neighbors;
    }

    /**
     * @param array $world
     * @param Cell $cell
     * @return array[]
     */
    private function computeNeighborPositions(array $world, Cell $cell) : array
    {
        $positions = [];
        for ($i = -1; $i < 2; $i++) {
            $cellY = $cell->getY() + $i;
            for ($j = -1; $j < 2; $j++) {
                $cellX = $cell->getX() + $j;
                if (
                    ($i === 0 && $j === 0) ||
                    (!isset($world[$cellY], $world[$cellY][$cellX]))
                ) {
                    continue;
                }
                $positions[] = [$cellX, $cellY];
            }
        }
        return $positions;
    }

    /**
     * @param string|null $map
     * @return array
     */
    public function init(string $map = null) : array
    {
        if ($map === null) {
            $cells = [];
            for ($i = 0; $i < 20; $i++) {
                if (!isset($cells[$i])) {
                    $cells[$i] = [];
                }
                for ($j = 0; $j < 20; $j++) {
                    $cells[$i][$j] = new Cell($j, $i);
                }
            }
        } else {
            $world = explode(PHP_EOL, $map);
            $cells = [];

            foreach ($world as $y => $row) {
                foreach (explode(' ', $row) as $x => $cellChar) {
                    if (!isset($cells[$y])) {
                        $cells[$y] = [];
                    }
                    $cells[$y][$x] = new Cell(
                        $x,
                        $y,
                        $cellChar === 'o'
                    );
                }
            }
        }


        foreach ($cells as $rows) {
            /** @var Cell $cell */
            foreach ($rows as $cell) {
                $cell->setNeighborPositions($this->computeNeighborPositions(
                    $cells,
                    $cell
                ));
            }
        }

        return $cells;
    }

    public function createNextGen(array $world) : array
    {
        $cells = [];
        foreach ($world as $row) {
            /** @var Cell $cell */
            foreach ($row as $cell) {
                if (!isset($cells[$cell->getY()])) {
                    $cells[$cell->getY()] = [];
                }
                $cells[$cell->getY()][$cell->getX()] = new Cell(
                    $cell->getX(),
                    $cell->getY(),
                    $cell->willBeAlive(new Cells(
                        $this->getNeighbors($cell->getNeighborPositions(), $world)
                    )),
                    $cell->getNeighborPositions()
                );
            }
        }
        return $cells;
    }
}
