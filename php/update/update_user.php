<?php

require "../dbconnect.php";

$id = $_POST["id"];
$name = $_POST["name"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"] ?? "";


// ✅ if may new password
if ($password != "") {

    // hash new password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
    "UPDATE user
     SET name=?, username=?, email=?, password=?
     WHERE id=?"
    );

    $stmt->execute([
        $name,
        $username,
        $email,
        $hashedPassword,
        $id
    ]);

} else {

    // no password change
    $stmt = $conn->prepare(
    "UPDATE user
     SET name=?, username=?, email=?
     WHERE id=?"
    );

    $stmt->execute([
        $name,
        $username,
        $email,
        $id
    ]);

}

echo json_encode([
    "status" => 1
]);