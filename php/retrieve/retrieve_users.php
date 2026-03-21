<?php

require "../dbconnect.php";


$stmt = $conn->prepare("SELECT * FROM user");
$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);