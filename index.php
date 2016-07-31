<?php

require_once __DIR__ . '/vendor/autoload.php';

$factory = new GameOfLife\WorldFactory();
$world = $factory->init();
$formatter = new \GameOfLife\Formatter\Cli();

for ($i = 0; $i < 1000; $i++) {
    echo $formatter->format($world);
    $newWorld = $factory->createNextGen($world);
    if ($newWorld == $world) {
        die('World stabilized');
    }
    $world = $newWorld;
    sleep(1);
    system('clear');
}
