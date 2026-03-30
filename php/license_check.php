<?php

require "dbconnect.php";

$sql = "SELECT * FROM system_license LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$status = $row['payment_status'];
$until = $row['license_until'];

$today = date("Y-m-d");

if ($status !== 'active') {
    header("Location: /mams-hernani/php/payment_required.php");
    exit;
}

if ($today > $until) {
    header("Location: /mams-hernani/php/payment_required.php");
    exit;
}