<?php

$folder = __DIR__ . "/../backup/";

$files = glob($folder . "*.sql");

foreach ($files as $file) {

    if (file_exists($file)) {

        unlink($file);

    }

}

echo "ok";