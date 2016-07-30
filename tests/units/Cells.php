<?php

namespace tests\units\GameOfLife;

use atoum;

class Cells extends atoum\test
{
    protected function testCountAliveDataProvider()
    {
        return [
            [
                [
                    new \GameOfLife\Cell(0, 1, true),
                    new \GameOfLife\Cell(0, 2, false),
                    new \GameOfLife\Cell(0, 3, false),
                    new \GameOfLife\Cell(0, 4, false),
                    new \GameOfLife\Cell(0, 5, true),
                    new \GameOfLife\Cell(0, 6, true),
                ],
                3
            ],
            [
                [],
                0
            ],
        ];
    }

    public function testCountAlive($cells, $countExpected)
    {
        $this
            ->object($this->newTestedInstance($cells))
                ->isTestedInstance()
            ->integer($this->testedInstance->countAlive())
                ->isIdenticalTo($countExpected);
    }
}
