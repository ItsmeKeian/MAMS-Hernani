<?php

$dbname = "mamshernani";

$conn = new PDO("mysql:host=localhost;dbname=$dbname", "root", "");

$stmt = $conn->prepare("
SELECT
SUM(data_length + index_length) AS size
FROM information_schema.tables
WHERE table_schema = ?
");

$stmt->execute([$dbname]);

$row = $stmt->fetch();

$bytes = $row["size"];

if ($bytes < 1024) {

    echo $bytes . " B";

} elseif ($bytes < 1024 * 1024) {

    echo number_format($bytes / 1024, 2) . " KB";

} elseif ($bytes < 1024 * 1024 * 1024) {

    echo number_format($bytes / 1024 / 1024, 2) . " MB";

} else {

    echo number_format($bytes / 1024 / 1024 / 1024, 2) . " GB";

}