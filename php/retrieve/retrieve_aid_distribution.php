<?php

require "../dbconnect.php";

$page = $_POST["page"] ?? 1;
$limit = $_POST["limit"] ?? 5;

$search = $_POST["search"] ?? "";
$barangay = $_POST["barangay"] ?? "";
$from = $_POST["from"] ?? "";
$to = $_POST["to"] ?? "";

$start = ($page - 1) * $limit;


$where = [];
$params = [];


// SEARCH

if ($search != "") {

    $where[] = "a.receiving_name LIKE :search";
    $params["search"] = "%$search%";

}


// BARANGAY (from beneficiaries)

if ($barangay != "") {

    $where[] = "b.addr_barangay = :barangay";
    $params["barangay"] = $barangay;

}


// DATE

if ($from != "" && $to != "") {

    $where[] = "a.date_received BETWEEN :from AND :to";

    $params["from"] = $from;
    $params["to"] = $to;

}


$whereSql = "";

if ($where) {

    $whereSql = "WHERE " . implode(" AND ", $where);

}


// COUNT

$totalSql = "

SELECT COUNT(*)

FROM assistance_records a

LEFT JOIN beneficiaries b
ON a.beneficiary_id = b.id

$whereSql

";

$totalStmt = $conn->prepare($totalSql);

foreach ($params as $k => $v) {

    $totalStmt->bindValue(":$k", $v);

}

$totalStmt->execute();

$total = $totalStmt->fetchColumn();


// DATA

$sql = "

SELECT 
a.*,
b.addr_barangay

FROM assistance_records a

LEFT JOIN beneficiaries b
ON a.beneficiary_id = b.id

$whereSql

ORDER BY a.id DESC

LIMIT $start, $limit

";

$stmt = $conn->prepare($sql);

foreach ($params as $k => $v) {

    $stmt->bindValue(":$k", $v);

}

$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode([

    "status" => 1,
    "data" => $data,
    "total" => $total

]);