<?php

require "../dbconnect.php";

$search = $_POST["search"] ?? "";
$from   = $_POST["from"] ?? "";
$to     = $_POST["to"] ?? "";

$sqlBase = "FROM assistance_records WHERE 1=1";
$params = [];


// ======================
// SEARCH
// ======================

if ($search != "") {

    $sqlBase .= " AND receiving_name LIKE ?";
    $params[] = "%$search%";

}


// ======================
// DATE RANGE
// ======================

if ($from != "" && $to != "") {

    $sqlBase .= " AND date_received BETWEEN ? AND ?";
    $params[] = $from;
    $params[] = $to;

}


// ======================
// TOTAL RECORDS
// ======================

$sql = "SELECT COUNT(*) " . $sqlBase;

$stmt = $conn->prepare($sql);
$stmt->execute($params);

$total = (int)$stmt->fetchColumn();


// ======================
// TOTAL QUANTITY
// ======================

$sql = "SELECT COALESCE(SUM(quantity),0) " . $sqlBase;

$stmt = $conn->prepare($sql);
$stmt->execute($params);

$totalQty = (int)$stmt->fetchColumn();


// ======================
// TOTAL COST
// ======================

$sql = "SELECT COALESCE(SUM(cost),0) " . $sqlBase;

$stmt = $conn->prepare($sql);
$stmt->execute($params);

$totalCost = (float)$stmt->fetchColumn();


// ======================
// TOTAL BENEFICIARIES
// ======================

$sql = "SELECT COUNT(DISTINCT beneficiary_id) " . $sqlBase;

$stmt = $conn->prepare($sql);
$stmt->execute($params);

$totalBen = (int)$stmt->fetchColumn();


// ======================
// RESPONSE
// ======================

echo json_encode([

    "total" => $total,
    "qty" => $totalQty,
    "cost" => $totalCost,
    "beneficiaries" => $totalBen

]);