<?php

require "../dbconnect.php";

$name = $_POST["name"];
$username = $_POST["username"];
$email = $_POST["email"];

$password = $_POST["password"];
$role = $_POST["role"];

$stmt = $conn->prepare(
"INSERT INTO user (name, username, email, password, role)
 VALUES (?, ?, ?, ?, ?)"
);

$stmt->execute([
    $name,
    $username,
    $email,
    $password,
    $role
]);

echo json_encode([
    "status" => 1
]);