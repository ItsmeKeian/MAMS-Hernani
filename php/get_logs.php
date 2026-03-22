<?php

require "dbconnect.php";

$stmt = $conn->query("
SELECT * FROM logs
ORDER BY id DESC
");

echo json_encode(
    $stmt->fetchAll(PDO::FETCH_ASSOC)
);