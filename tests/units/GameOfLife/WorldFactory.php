<?php

namespace tests\units\GameOfLife;

use atoum;

class WorldFactory extends atoum\test
{
    protected function testInitDataProvider()
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

        return [
            [
                $cellMap,
                [
                    [4, 3],
                    [5, 2],
                    [5, 3],
                    [5, 4],
                    [6, 3],
                ],
            ],
            [
                null,
                [],
            ]
        ];
    }

    public function testInit(string $cellString = null, array $aliveCells)
    {
        $this
            ->object($this->newTestedInstance())
                ->isTestedInstance();

        $aliveCellPositions = $aliveCells;

        $this->array($result = $this->testedInstance->init($cellString));

        foreach ($result as $posY => $row) {
            foreach ($row as $posX => $cell) {
                $this
                    ->object($cell)
                        ->isInstanceOf(\GameOfLife\Cell::class)
                    ->integer($posX)
                        ->isIdenticalTo($cell->getX())
                    ->integer($posY)
                        ->isIdenticalTo($cell->getY());
                ;

                if ($cell->isAlive() && count($aliveCells)) {
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

        $this->array($calculated = $this->testedInstance->createNextGen($initial));

        foreach ($calculated as $rows) {
            /** @var \GameOfLife\Cell $cell */
            foreach ($rows as $cell) {
                $this
                    ->boolean($final[$cell->getY()][$cell->getX()]->isAlive())
                        ->isIdenticalTo($cell->isAlive(), "Wrong value for cell {$cell->getX()},{$cell->getY()}");
            }
        }
    }
}
