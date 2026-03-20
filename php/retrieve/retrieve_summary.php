<?php

require "../dbconnect.php";

$search = $_POST["search"] ?? "";
$barangay = $_POST["barangay"] ?? "";
$from = $_POST["from"] ?? "";
$to = $_POST["to"] ?? "";
$damage = $_POST["damage"] ?? "";


$sqlBase = "FROM beneficiaries WHERE 1=1";
$params = [];


// SEARCH
if ($search != "") {
    $sqlBase .= " AND (last_name LIKE ? OR first_name LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}


// BARANGAY
if ($barangay != "") {
    $sqlBase .= " AND addr_barangay = ?";
    $params[] = $barangay;
}


// DATE RANGE
if ($from != "" && $to != "") {
    $sqlBase .= " AND date_registered BETWEEN ? AND ?";
    $params[] = $from;
    $params[] = $to;
}


// DAMAGE FILTER
if ($damage != "") {
    $sqlBase .= " AND damage_classification = ?";
    $params[] = $damage;
}



//////////////////////
// TOTAL
//////////////////////

$sql = "SELECT COUNT(*) " . $sqlBase;

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$total = $stmt->fetchColumn();



//////////////////////
// PARTIAL
//////////////////////

$sql = "SELECT COUNT(*) " . $sqlBase . " AND damage_classification = 'Partially damage'";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$partial = $stmt->fetchColumn();



//////////////////////
// TOTAL DAMAGE
//////////////////////

$sql = "SELECT COUNT(*) " . $sqlBase . " AND damage_classification = 'Totally damage'";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$totalDamage = $stmt->fetchColumn();



//////////////////////
// 4PS
//////////////////////

$sql = "SELECT COUNT(*) " . $sqlBase . " AND is_4ps = 1";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$fourps = $stmt->fetchColumn();



echo json_encode([
    "total" => $total,
    "partial" => $partial,
    "totalDamage" => $totalDamage,
    "fourps" => $fourps
]);