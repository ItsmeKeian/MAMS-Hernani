<?php

require "php/dbconnect.php";

$id = $_GET["id"];

/* BENEFICIARY */

$stmt = $conn->prepare("
SELECT * FROM beneficiaries
WHERE id = ?
");

$stmt->execute([$id]);

$b = $stmt->fetch(PDO::FETCH_ASSOC);


/* FAMILY */

$famStmt = $conn->prepare("
SELECT * FROM family_members
WHERE beneficiary_id = ?
");

$famStmt->execute([$id]);

$family = $famStmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>

<title>FACED FORM</title>

<style>

body{
font-family: Arial, sans-serif;
background:#eee;
}

.print-btn{
margin:10px;
}

.form{
width:900px;
margin:auto;
background:white;
border:2px solid #000;
padding:10px;
font-size:12px;
}

.header{
text-align:center;
font-weight:bold;
}

.section-title{
background:#1f3a5f;
color:white;
padding:3px;
font-weight:bold;
margin-top:5px;
}

.row{
display:flex;
margin-bottom:3px;
}

.label{
width:150px;
}

.value{
flex:1;
border-bottom:1px solid black;
}

table{
width:100%;
border-collapse:collapse;
font-size:12px;
}

th,td{
border:1px solid black;
padding:2px;
text-align:left;
}

.signature{
margin-top:20px;
display:flex;
justify-content:space-between;
}

.sig-box{
width:45%;
text-align:center;
}

.thumb{
width:80px;
height:80px;
border:1px solid black;
}

@media print{

.print-btn{
display:none;
}

body{
background:white;
}

}

</style>

</head>
<body>


<button class="print-btn" onclick="window.print()">
Print
</button>


<div class="form">

<div class="header">

Republic of the Philippines<br>
Department of Social Welfare and Development<br>
FAMILY ASSISTANCE CARD IN EMERGENCIES AND DISASTERS (FACED)

</div>


<div class="section-title">
LOCATION OF THE AFFECTED FAMILY
</div>

<div class="row">
<div class="label">Region</div>
<div class="value"><?= $b["region"] ?></div>

<div class="label">District</div>
<div class="value"><?= $b["district"] ?></div>
</div>

<div class="row">
<div class="label">Province</div>
<div class="value"><?= $b["province"] ?></div>

<div class="label">Barangay</div>
<div class="value"><?= $b["barangay"] ?></div>
</div>

<div class="row">
<div class="label">Municipality</div>
<div class="value"><?= $b["municipality"] ?></div>

<div class="label">Evacuation</div>
<div class="value"><?= $b["evacuation_site"] ?></div>
</div>



<div class="section-title">
HEAD OF THE FAMILY
</div>

<div class="row">
<div class="label">Last Name</div>
<div class="value"><?= $b["last_name"] ?></div>

<div class="label">Civil Status</div>
<div class="value"><?= $b["civil_status"] ?></div>
</div>

<div class="row">
<div class="label">First Name</div>
<div class="value"><?= $b["first_name"] ?></div>

<div class="label">Mother's Maiden</div>
<div class="value"><?= $b["mothers_maiden_name"] ?></div>
</div>

<div class="row">
<div class="label">Birthdate</div>
<div class="value"><?= $b["birthdate"] ?></div>

<div class="label">Religion</div>
<div class="value"><?= $b["religion"] ?></div>
</div>

<div class="row">
<div class="label">Age</div>
<div class="value"><?= $b["age"] ?></div>

<div class="label">Occupation</div>
<div class="value"><?= $b["occupation"] ?></div>
</div>

<div class="row">
<div class="label">Contact</div>
<div class="value"><?= $b["contact_number"] ?></div>

<div class="label">Income</div>
<div class="value"><?= $b["monthly_income"] ?></div>
</div>



<div class="section-title">
PERMANENT ADDRESS
</div>

<div class="row">
<div class="label">Address</div>
<div class="value">

<?= $b["house_no"] ?>
<?= $b["street"] ?>
<?= $b["addr_barangay"] ?>
<?= $b["addr_city"] ?>
<?= $b["addr_province"] ?>

</div>
</div>



<div class="section-title">
FAMILY INFORMATION
</div>

<table>

<tr>

<th>Name</th>
<th>Relation</th>
<th>Birthdate</th>
<th>Age</th>
<th>Sex</th>
<th>Education</th>
<th>Occupation</th>
<th>Vulnerability</th>

</tr>

<?php foreach($family as $f): ?>

<tr>

<td><?= $f["name"] ?></td>
<td><?= $f["relation"] ?></td>
<td><?= $f["birthdate"] ?></td>
<td><?= $f["age"] ?></td>
<td><?= $f["sex"] ?></td>
<td><?= $f["education"] ?></td>
<td><?= $f["occupation"] ?></td>
<td><?= $f["vulnerability"] ?></td>

</tr>

<?php endforeach; ?>

</table>



<div class="section-title">
HOUSE DAMAGE
</div>

<div class="row">
<div class="label">Ownership</div>
<div class="value"><?= $b["ownership"] ?></div>

<div class="label">Damage</div>
<div class="value"><?= $b["damage_classification"] ?></div>
</div>



<div class="signature">

<div class="sig-box">

<div class="thumb"></div>

Right Thumbmark

</div>


<div class="sig-box">

Signature of Family Head

</div>

</div>


</div>

</body>
</html>