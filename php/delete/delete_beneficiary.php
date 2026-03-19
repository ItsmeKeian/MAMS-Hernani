<?php

require "../dbconnect.php";

$id = $_POST["id"];

$sql = "DELETE FROM beneficiaries WHERE id=?";

$stmt = $conn->prepare($sql);

if ($stmt->execute([$id])) {

    echo json_encode([
        "status" => 1
    ]);

} else {

    echo json_encode([
        "status" => 0
    ]);

}