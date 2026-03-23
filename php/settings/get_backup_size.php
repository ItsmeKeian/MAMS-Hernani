<?php

$folder = __DIR__ . "/../backup/";

$total = 0;

$files = glob($folder . "*.sql");

if (!$files) {
    echo "0 B";
    exit;
}

foreach ($files as $file) {

    if (file_exists($file)) {

        $size = filesize($file);

        if ($size !== false) {
            $total += $size;
        }

    }

}

if ($total <= 0) {
    echo "0 B";
    exit;
}

if ($total < 1024) {

    echo $total . " B";

} elseif ($total < 1024 * 1024) {

    echo number_format($total / 1024, 2) . " KB";

} elseif ($total < 1024 * 1024 * 1024) {

    echo number_format($total / 1024 / 1024, 2) . " MB";

} else {

    echo number_format($total / 1024 / 1024 / 1024, 2) . " GB";

}