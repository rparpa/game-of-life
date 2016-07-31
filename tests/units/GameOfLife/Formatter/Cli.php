<?php


namespace tests\units\GameOfLife\Formatter;

use atoum;

class Cli extends atoum\test
{
    public function testFormat()
    {
        $world = <<<WORLD
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
WORLD;

        $expected = <<<EXPECTED
                           
                           
          •                
        • • •              
          •                
                           
                           
                           
                           
                           
                           
EXPECTED;
        $factory = new \GameOfLife\WorldFactory;
        $world   = $factory->init($world);

        $this
            ->object($this->newTestedInstance())
                ->isTestedInstance()

            ->string($this->testedInstance->format($world))
                ->isIdenticalTo($expected);
    }
}