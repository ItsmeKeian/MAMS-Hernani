<?php

function addLog($conn, $user, $action, $module, $details)
{

    $stmt = $conn->prepare("
        INSERT INTO logs
        (user, action, module, details)
        VALUES (?,?,?,?)
    ");

    $stmt->execute([
        $user,
        $action,
        $module,
        $details
    ]);

}