<?php

namespace GameOfLife;

class WorldFactory
{
    private function getNeighbors(array $world, Cell $cell)
    {
        $neighbors = [];
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
                $neighbors[] = $world[$cellY][$cellX];
            }
        }
        return $neighbors;
    }

    public function init(string $map) : array
    {
        $cellRows = explode(PHP_EOL, $map);
        $cells = [];

        foreach ($cellRows as $y => $row) {
            foreach (explode(' ', $row) as $x => $cellChar) {
                if (!isset($cells[$y])) {
                    $cells[$y] = [];
                }
                $cells[$y][$x] = new Cell($x, $y, $cellChar === 'o');
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
                        $this->getNeighbors($world, $cell)
                    ))
                );
            }
        }
        return $cells;
    }
}
