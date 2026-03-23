<?php

require "../dbconnect.php";

$page = $_POST["page"] ?? 1;
$limit = $_POST["limit"] ?? 5;

$search = $_POST["search"] ?? "";

$start = ($page - 1) * $limit;


$where = [];
$params = [];


if ($search != "") {

    $where[] = "user LIKE :search";
    $params["search"] = "%$search%";

}


$whereSql = "";

if ($where) {

    $whereSql = "WHERE " . implode(" AND ", $where);

}


// COUNT

$totalSql = "

SELECT COUNT(*)

FROM logs

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

SELECT *

FROM logs

$whereSql

ORDER BY id DESC

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