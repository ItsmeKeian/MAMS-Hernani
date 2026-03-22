<?php

require "../dbconnect.php";

$page = $_POST["page"] ?? 1;
$limit = $_POST["limit"] ?? 5;
$search = $_POST["search"] ?? "";
$barangay = $_POST["barangay"] ?? "";
$from = $_POST["from"] ?? "";
$to = $_POST["to"] ?? "";
$damage = $_POST["damage"] ?? "";

$start = ($page - 1) * $limit;


// =====================
// BUILD WHERE
// =====================

$where = [];
$params = [];


if ($search != "") {

    $where[] = "(b.last_name LIKE :search OR b.first_name LIKE :search)";
    $params["search"] = "%$search%";

}

if ($barangay != "") {

    $where[] = "addr_barangay = :barangay";
    $params["barangay"] = $barangay;

}

if ($from != "" && $to != "") {

    $where[] = "date_registered BETWEEN :from AND :to";

    $params["from"] = $from;
    $params["to"] = $to;

}

if ($damage != "") {

    $where[] = "damage_classification = :damage";
    $params["damage"] = $damage;

}


$whereSql = "";

if (count($where) > 0) {

    $whereSql = "WHERE " . implode(" AND ", $where);

}


// =====================
// COUNT
// =====================

$totalSql = "

SELECT COUNT(*)

FROM assistance_records a

LEFT JOIN beneficiaries b
ON a.beneficiary_id = b.id

$whereSql

";

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

SELECT 

a.*,
b.last_name,
b.first_name

FROM assistance_records a

LEFT JOIN beneficiaries b
ON a.beneficiary_id = b.id

$whereSql

ORDER BY a.id DESC

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