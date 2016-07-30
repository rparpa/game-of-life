<?php

namespace tests\units\GameOfLife;

use atoum;

class WorldFactory extends atoum\test
{
    public function testInit()
    {
        $cellMap = <<<MAP
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + o + + + + + + + +
+ + + + o o o + + + + + + +
+ + + + + o + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
MAP;

        $this
            ->object($this->newTestedInstance())
                ->isTestedInstance()

            ->array($result = $this->testedInstance->init($cellMap))
                ->hasSize(11);

        $aliveCellPositions = [
            [4, 3],
            [5, 2],
            [5, 3],
            [5, 4],
            [6, 3],
        ];

        foreach ($result as $posY => $row) {
            $this
                ->array($row)
                    ->hasSize(14);

            foreach ($row as $posX => $cell) {
                $this
                    ->object($cell)
                        ->isInstanceOf(\GameOfLife\Cell::class)
                    ->integer($posX)
                        ->isIdenticalTo($cell->getX())
                    ->integer($posY)
                        ->isIdenticalTo($cell->getY());
                ;

                if ($cell->isAlive()) {
                    $this
                        ->array($aliveCellPositions)
                            ->contains([$cell->getX(), $cell->getY()]);
                }
            }
        }
    }

    public function testCreateNextGen()
    {
        $cellMap = <<<MAP
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + o + + + + + + + +
+ + + + o o o + + + + + + +
+ + + + + o + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
MAP;

        $nexGenMap = <<<NEXTGEN
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + o o o + + + + + + +
+ + + + o + o + + + + + + +
+ + + + o o o + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
+ + + + + + + + + + + + + +
NEXTGEN;

        $this
            ->object($this->newTestedInstance())
                ->isTestedInstance();

        $initial = $this->testedInstance->init($cellMap);
        $final   = $this->testedInstance->init($nexGenMap);

        $this
            ->array($this->testedInstance->createNextGen($initial))
                ->isEqualTo($final);
    }
}
