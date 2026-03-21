<?php

require "../dbconnect.php";

$id = $_POST["id"];

$stmt = $conn->prepare(
"DELETE FROM user WHERE id=?"
);

$stmt->execute([$id]);

echo json_encode([
    "status" => 1
]);