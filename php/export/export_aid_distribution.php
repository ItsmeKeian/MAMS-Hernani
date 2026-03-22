<?php

require "../dbconnect.php";

$barangay = $_GET["barangay"] ?? "";
$search   = $_GET["search"] ?? "";
$from     = $_GET["from"] ?? "";
$to       = $_GET["to"] ?? "";


// =========================
// FILENAME
// =========================

$filename = "aid_distribution";

if ($barangay != "") {
    $filename .= "_barangay_" . $barangay;
}

if ($search != "") {
    $filename .= "_search_" . $search;
}

if ($from != "" && $to != "") {
    $filename .= "_date_" . $from . "_to_" . $to;
}

$filename .= ".xls";


header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");


// =========================
// TABLE HEADER
// =========================

echo "<table border='1'>";

echo "<tr>

<th>Name</th>
<th>Barangay</th>
<th>Disaster</th>
<th>Assistance</th>
<th>Unit</th>
<th>Quantity</th>
<th>Cost</th>
<th>Provider</th>
<th>Date Received</th>

</tr>";


// =========================
// SQL
// =========================

$sql = "

SELECT

a.receiving_name,
a.disaster_type,
a.assistance_type,
a.unit,
a.quantity,
a.cost,
a.provider,
a.date_received,

b.addr_barangay

FROM assistance_records a

LEFT JOIN beneficiaries b
ON a.beneficiary_id = b.id

WHERE 1=1

";

$params = [];


// SEARCH

if ($search != "") {

    $sql .= " AND a.receiving_name LIKE ?";
    $params[] = "%$search%";

}


// BARANGAY (FROM BENEFICIARIES)

if ($barangay != "") {

    $sql .= " AND b.addr_barangay LIKE ?";
    $params[] = "%$barangay%";

}


// DATE

if ($from != "" && $to != "") {

    $sql .= " AND a.date_received BETWEEN ? AND ?";
    $params[] = $from;
    $params[] = $to;

}


$sql .= " ORDER BY a.id DESC";


$stmt = $conn->prepare($sql);
$stmt->execute($params);

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


// =========================
// OUTPUT
// =========================

foreach ($data as $r) {

echo "<tr>

<td>{$r['receiving_name']}</td>
<td>{$r['addr_barangay']}</td>
<td>{$r['disaster_type']}</td>
<td>{$r['assistance_type']}</td>
<td>{$r['unit']}</td>
<td>{$r['quantity']}</td>
<td>{$r['cost']}</td>
<td>{$r['provider']}</td>
<td>{$r['date_received']}</td>

</tr>";

}


echo "</table>";