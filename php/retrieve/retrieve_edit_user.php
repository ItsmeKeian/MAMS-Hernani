<?php

require "../dbconnect.php";

$id = $_POST["id"];

$stmt = $conn->prepare(
    "SELECT * FROM user WHERE id=?"
);

$stmt->execute([$id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($user);