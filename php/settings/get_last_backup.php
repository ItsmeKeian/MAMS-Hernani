<?php

$folder = "../backup/";

$files = glob($folder . "*.sql");

if (!$files) {

    echo "No backup yet";
    exit;
}

usort($files, function ($a, $b) {
    return filemtime($b) - filemtime($a);
});

echo date("Y-m-d H:i:s", filemtime($files[0]));