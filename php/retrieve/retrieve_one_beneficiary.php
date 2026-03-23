<?php

require "../dbconnect.php";

$id = $_POST["id"];

// ================= BENEFICIARY =================

$stmt = $conn->prepare("
SELECT *
FROM beneficiaries
WHERE id = ?
");

$stmt->execute([$id]);

$beneficiary = $stmt->fetch(PDO::FETCH_ASSOC);


// ================= FAMILY =================

$fam = $conn->prepare("
SELECT *
FROM family_members
WHERE beneficiary_id = ?
");

$fam->execute([$id]);

$family = $fam->fetchAll(PDO::FETCH_ASSOC);


// ================= ASSISTANCE =================

$aid = $conn->prepare("
SELECT *
FROM assistance_records
WHERE beneficiary_id = ?
");

$aid->execute([$id]);

$assistance = $aid->fetchAll(PDO::FETCH_ASSOC);


// ================= OUTPUT =================

echo json_encode([
    "beneficiary" => $beneficiary,
    "family" => $family,
    "assistance" => $assistance
]);