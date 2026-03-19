<?php

require "../dbconnect.php";

$page = $_POST["page"] ?? 1;
$limit = $_POST["limit"] ?? 5;
$search = $_POST["search"] ?? "";
$barangay = $_POST["barangay"] ?? "";

$start = ($page - 1) * $limit;


// =====================
// BUILD WHERE
// =====================

$where = [];
$params = [];


if ($search != "") {

    $where[] = "(last_name LIKE :search OR first_name LIKE :search)";
    $params["search"] = "%$search%";

}

if ($barangay != "") {

    $where[] = "addr_barangay = :barangay";
    $params["barangay"] = $barangay;

}


$whereSql = "";

if (count($where) > 0) {

    $whereSql = "WHERE " . implode(" AND ", $where);

}


// =====================
// COUNT
// =====================

$totalSql = "SELECT COUNT(*) FROM beneficiaries $whereSql";

$totalStmt = $conn->prepare($totalSql);

foreach ($params as $key => $val) {

    $totalStmt->bindValue(":$key", $val);

}

$totalStmt->execute();

$total = $totalStmt->fetchColumn();


// =====================
// GET DATA
// =====================

$sql = "

SELECT *
FROM beneficiaries

$whereSql

ORDER BY id DESC

LIMIT $start, $limit

";

$stmt = $conn->prepare($sql);

foreach ($params as $key => $val) {

    $stmt->bindValue(":$key", $val);

}

$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


// =====================
// RESPONSE
// =====================

echo json_encode([

    "status" => 1,
    "data" => $data,
    "total" => $total

]);