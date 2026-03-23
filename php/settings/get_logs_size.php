<?php

require "../dbconnect.php";


$sql = "

SELECT
SUM(
    LENGTH(user) +
    LENGTH(action) +
    LENGTH(module) +
    LENGTH(details)
) AS total_bytes

FROM logs

";

$stmt = $conn->query($sql);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$bytes = $row["total_bytes"] ?? 0;


if ($bytes < 1024) {

    $size = $bytes . " B";

}
elseif ($bytes < 1024 * 1024) {

    $size = round($bytes / 1024, 2) . " KB";

}
else {

    $size = round($bytes / 1024 / 1024, 2) . " MB";

}

echo $size;