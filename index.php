<?php

require_once __DIR__ . '/vendor/autoload.php';

$factory = new GameOfLife\WorldFactory();
$world = $factory->init();
$newWorld = $world;
$formatter = new \GameOfLife\Formatter\Cli();
$iteration = 1;

do {
    $world = $newWorld;
    $newWorld = $factory->createNextGen($world);
    echo $formatter->format($world);
    echo PHP_EOL . PHP_EOL . 'Iteration : ' . $iteration . PHP_EOL;
    $iteration++;

    if ($iteration === 10000) {
        break;
    }
    usleep(500000);
    system('clear');
} while ($newWorld != $world);
