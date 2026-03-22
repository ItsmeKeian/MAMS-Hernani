<?php

require "../dbconnect.php";

$barangay = $_GET["barangay"] ?? "";
$search   = $_GET["search"] ?? "";
$from     = $_GET["from"] ?? "";
$to       = $_GET["to"] ?? "";

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


// BARANGAY

if ($barangay != "") {

    $sql .= " AND b.addr_barangay = ?";
    $params[] = $barangay;

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

?>
<!DOCTYPE html>
<html>
<head>

<title>Aid Distribution Report</title>

<style>

body{
font-family: Arial;
}

.header{
text-align:center;
margin-bottom:20px;
}

table{
width:100%;
border-collapse:collapse;
}

th,td{
border:1px solid black;
padding:5px;
font-size:12px;
}

@media print{

button{
display:none;
}

}

</style>

</head>
<body>


<div class="header">

<table width="100%" border="0">

<tr>

<td width="120">
<img src="../../assets/img/logo.jpg" width="90">
</td>

<td align="center">

<h2>Republic of the Philippines</h2>
<h2>Municipality of Hernani</h2>
<h3>Municipal Aid Monitoring System</h3>
<h3>Aid Distribution Report</h3>

<?php if($from && $to): ?>

<p>
Date Range:
<?= $from ?> to <?= $to ?>
</p>

<?php endif; ?>

</td>

<td width="120"></td>

</tr>

</table>

<hr>

</div>


<button onclick="window.print()">Print</button>


<table>

<tr>

<th>Name</th>
<th>Barangay</th>
<th>Disaster</th>
<th>Assistance</th>
<th>Unit</th>
<th>Qty</th>
<th>Cost</th>
<th>Provider</th>
<th>Date</th>

</tr>

<?php foreach($data as $r): ?>

<tr>

<td><?= $r["receiving_name"] ?></td>
<td><?= $r["addr_barangay"] ?></td>
<td><?= $r["disaster_type"] ?></td>
<td><?= $r["assistance_type"] ?></td>
<td><?= $r["unit"] ?></td>
<td><?= $r["quantity"] ?></td>
<td><?= $r["cost"] ?></td>
<td><?= $r["provider"] ?></td>
<td><?= $r["date_received"] ?></td>

</tr>

<?php endforeach; ?>

</table>


</body>
</html>