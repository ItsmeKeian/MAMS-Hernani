<?php

require "dbconnect.php";

$data = [];


/* TOTAL BENEFICIARIES */
$data["totalBen"] = $conn->query("
SELECT COUNT(*) FROM beneficiaries
")->fetchColumn();


/* TOTAL AID RECORDS */
$data["totalAid"] = $conn->query("
SELECT COUNT(*) FROM assistance_records
")->fetchColumn();


/* TOTAL QUANTITY */
$data["totalQty"] = $conn->query("
SELECT IFNULL(SUM(quantity),0) FROM assistance_records
")->fetchColumn();


/* TOTAL COST */
$data["totalCost"] = $conn->query("
SELECT IFNULL(SUM(cost),0) FROM assistance_records
")->fetchColumn();



/* =========================
   BARANGAY CHART
========================= */

$stmt = $conn->query("
SELECT addr_barangay, COUNT(*) total
FROM beneficiaries
GROUP BY addr_barangay
");

$labels = [];
$values = [];

foreach ($stmt as $r) {

    $labels[] = $r["addr_barangay"];
    $values[] = $r["total"];

}

$data["brgyLabels"] = $labels;
$data["brgyData"] = $values;



/* =========================
   MONTH CHART
========================= */

$stmt = $conn->query("
SELECT 
DATE_FORMAT(date_received, '%M %Y') mname,
COUNT(*) total,
MIN(date_received) d
FROM assistance_records
GROUP BY YEAR(date_received), MONTH(date_received)
ORDER BY d
");

$monthLabels = [];
$monthData = [];

foreach ($stmt as $r) {

    $monthLabels[] = $r["mname"];
    $monthData[] = $r["total"];

}

$data["monthLabels"] = $monthLabels;
$data["monthData"] = $monthData;

/* =========================
   ASSISTANCE TYPE CHART
========================= */

$stmt = $conn->query("
SELECT assistance_type, COUNT(*) total
FROM assistance_records
GROUP BY assistance_type
");

$itemLabels = [];
$itemData = [];

foreach ($stmt as $r) {

    $itemLabels[] = $r["assistance_type"];
    $itemData[] = $r["total"];

}

$data["itemLabels"] = $itemLabels;
$data["itemData"] = $itemData;


/* =========================
   DISASTER CHART
========================= */

$stmt = $conn->query("
SELECT disaster_type, COUNT(*) total
FROM assistance_records
GROUP BY disaster_type
");

$dLabels = [];
$dData = [];

foreach ($stmt as $r) {

    $dLabels[] = $r["disaster_type"];
    $dData[] = $r["total"];

}

$data["disasterLabels"] = $dLabels;
$data["disasterData"] = $dData;

echo json_encode($data);