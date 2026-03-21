<?php

session_start();

require "dbconnect.php";

$username = $_POST["username"];
$password = $_POST["password"];

$stmt = $conn->prepare(
    "SELECT * FROM user WHERE username=?"
);

$stmt->execute([$username]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {

    // if using plain password (your current)
    if ($password == $user["password"]) {

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        echo json_encode([
            "status" => "success",
            "role" => $user["role"]
        ]);

    } else {

        echo json_encode([
            "status" => "error",
            "message" => "Wrong password"
        ]);

    }

} else {

    echo json_encode([
        "status" => "error",
        "message" => "User not found"
    ]);

}