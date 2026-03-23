<?php

require "../dbconnect.php";

$dbname = "mamshernani";

$stmt = $conn->prepare("
SELECT
IFNULL(SUM(data_length + index_length),0) AS size
FROM information_schema.tables
WHERE table_schema = ?
");

$stmt->execute([$dbname]);

$row = $stmt->fetch();

$bytes = (int)$row["size"];


if ($bytes <= 0) {

    echo "0 KB";
    exit;

}

if ($bytes < 1024) {

    echo $bytes . " B";

} elseif ($bytes < 1024 * 1024) {

    echo number_format($bytes / 1024, 2) . " KB";

} else {

    echo number_format($bytes / 1024 / 1024, 2) . " MB";

}