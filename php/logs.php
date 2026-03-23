<?php

require "dbconnect.php";

function addLog($action, $module, $details)
{
    if (!isset($_SESSION)) {
        session_start();
    }

    // log only user
    if (!isset($_SESSION["role"]) || $_SESSION["role"] != "user") {
        return;
    }

    global $conn;

    $stmt = $conn->prepare(
        "INSERT INTO logs (user, action, module, details)
         VALUES (?, ?, ?, ?)"
    );

    $stmt->execute([
        $_SESSION["username"],
        $action,
        $module,
        $details
    ]);
}