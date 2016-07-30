<?php

use mageekguy\atoum;

$extension = new mageekguy\atoum\autoloop\extension($script);
$extension
    ->setWatchedFiles(array(__DIR__ . '/src'))
    ->addToRunner($runner)
;
$runner->addTestsFromDirectory(__DIR__ . '/tests');
$runner->setBootstrapFile(__DIR__ . '/.bootstrap.php');
