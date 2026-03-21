<?php

require "../dbconnect.php";

$id = $_POST["id"];
$name = $_POST["name"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"] ?? "";

if($password != ""){

    $stmt = $conn->prepare(
    "UPDATE user
     SET name=?, username=?, email=?, password=?
     WHERE id=?"
    );

    $stmt->execute([
        $name,
        $username,
        $email,
        $password,
        $id
    ]);

}else{

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
    "status"=>1
]);