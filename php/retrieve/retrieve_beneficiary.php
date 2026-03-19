<?php

require "../dbconnect.php";

$page = $_POST["page"] ?? 1;
$limit = $_POST["limit"] ?? 10;
$search = $_POST["search"] ?? "";

$start = ($page - 1) * $limit;

$where = "";

if ($search != "") {

    $where = "WHERE last_name LIKE :search
              OR first_name LIKE :search";

}

$totalSql = "SELECT COUNT(*) FROM beneficiaries $where";
$totalStmt = $conn->prepare($totalSql);

if ($search != "") {
    $totalStmt->bindValue(":search", "%$search%");
}

$totalStmt->execute();
$total = $totalStmt->fetchColumn();


$sql = "SELECT * FROM beneficiaries
        $where
        ORDER BY id DESC
        LIMIT $start,$limit";

$stmt = $conn->prepare($sql);

if ($search != "") {
    $stmt->bindValue(":search", "%$search%");
}

$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode([
    "status" => 1,
    "data" => $data,
    "total" => $total
]);