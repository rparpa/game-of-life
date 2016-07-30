<?php

namespace tests\units\GameOfLife;

use atoum;

class Cell extends atoum\test
{
    public function beforeTestMethod($testMethod)
    {
        parent::beforeTestMethod($testMethod);
        $this->getMockGenerator()->allIsInterface();
    }

    public function testConstruct()
    {
        $this
            ->object($this->newTestedInstance(1, 2))
                ->isTestedInstance();
    }

    public function testIsAlive()
    {
        $this
            ->object($this->newTestedInstance(1, 2))
                ->isTestedInstance()

            ->object($this->testedInstance->setAlive(true))
                ->isTestedInstance()

            ->boolean($this->testedInstance->isAlive())
                ->isIdenticalTo(true);
    }

    protected function testWillBeAliveDataProvider()
    {
        return [
            [true, 0, false],
            [true, 1, false],
            [true, 2, true],
            [true, 3, true],
            [true, 4, false],
            [true, 5, false],
            [true, 6, false],
            [true, 7, false],
            [true, 8, false],

            [false, 0, false],
            [false, 1, false],
            [false, 2, false],
            [false, 3, true],
            [false, 4, false],
            [false, 5, false],
            [false, 6, false],
            [false, 7, false],
            [false, 8, false],
        ];
    }

    public function testWillBeAlive($isAlive, $numberOfNeighborsAlive, $expected)
    {
        $cells = new \mock\GameOfLife\Cells;
        $this->calling($cells)->countAlive = $numberOfNeighborsAlive;
        $state = $isAlive ? 'Living' : 'Dead';
        $expectedSate = $expected ? 'Living' : 'Dead';

        $this
            ->object($this->newTestedInstance(1, 2, $isAlive))
                ->isTestedInstance()

            ->boolean($this->testedInstance->willBeAlive($cells))
                ->isIdenticalTo($expected, "$state cell with $numberOfNeighborsAlive living neighbors should be $expectedSate");
    }

}
