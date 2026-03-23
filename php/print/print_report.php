<?php

require "../dbconnect.php";
require "../logs.php";

$barangay = $_GET["barangay"] ?? "";
$search = $_GET["search"] ?? "";
$from = $_GET["from"] ?? "";
$to = $_GET["to"] ?? "";
$damage = $_GET["damage"] ?? "";


// ================= LOG =================

$details = "Printed beneficiary report";

if ($barangay != "") $details .= " | Brgy: $barangay";
if ($damage != "") $details .= " | Damage: $damage";
if ($search != "") $details .= " | Search: $search";
if ($from && $to) $details .= " | Date: $from to $to";

addLog("print", "beneficiaries", $details);


// ================= SQL =================

$sql = "SELECT * FROM beneficiaries WHERE 1=1";

$params = [];


if ($barangay != "") {
    $sql .= " AND addr_barangay = ?";
    $params[] = $barangay;
}

if ($search != "") {
    $sql .= " AND (last_name LIKE ? OR first_name LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($from != "" && $to != "") {
    $sql .= " AND date_registered BETWEEN ? AND ?";
    $params[] = $from;
    $params[] = $to;
}

if ($damage != "") {
    $sql .= " AND damage_classification = ?";
    $params[] = $damage;
}


$stmt = $conn->prepare($sql);
$stmt->execute($params);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>

<title>Print Report</title>

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
<h3>Beneficiary Report</h3>

<?php if($from && $to): ?>
<p>Date Range: <?= $from ?> to <?= $to ?></p>
<?php endif; ?>

<?php if($barangay): ?>
<p>Barangay: <?= $barangay ?></p>
<?php endif; ?>

<?php if($damage): ?>
<p>Damage: <?= $damage ?></p>
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
<th>Age</th>
<th>Contact</th>
<th>Damage</th>
<th>Date</th>

</tr>

<?php foreach($data as $b): ?>

<tr>

<td>
<?= $b["last_name"] ?> <?= $b["first_name"] ?>
</td>

<td><?= $b["addr_barangay"] ?></td>
<td><?= $b["age"] ?></td>
<td><?= $b["contact_number"] ?></td>
<td><?= $b["damage_classification"] ?></td>
<td><?= $b["date_registered"] ?></td>

</tr>

<?php endforeach; ?>

</table>


</body>
</html>