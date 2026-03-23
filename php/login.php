<?php

session_start();

require "dbconnect.php";
require "logs.php";

$username = $_POST["username"];
$password = $_POST["password"];

$stmt = $conn->prepare(
    "SELECT * FROM user WHERE username=?"
);

$stmt->execute([$username]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {

    if (password_verify($password, $user["password"])) {

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        addLog(
            "login",
            "authentication",
            "User logged in"
        );

        echo json_encode([
            "status" => "success",
            "role" => $user["role"]
        ]);

    } else {

        addLog(
            "login_failed",
            "auth",
            "Wrong password: " . $username
        );

        echo json_encode([
            "status" => "error",
            "message" => "Wrong password"
        ]);

    }

} else {

    addLog(
        "login_failed",
        "auth",
        "User not found: " . $username
    );

    echo json_encode([
        "status" => "error",
        "message" => "User not found"
    ]);

}