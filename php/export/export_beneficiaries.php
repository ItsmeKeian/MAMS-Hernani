<?php

require "../dbconnect.php";

$barangay = $_GET["barangay"] ?? "";
$search = $_GET["search"] ?? "";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=beneficiaries.xls");


echo "<table border='1'>";

echo "<tr>

<th>ID</th>
<th>Region</th>
<th>Province</th>
<th>Municipality</th>
<th>District</th>
<th>Barangay</th>
<th>Evacuation</th>

<th>Last</th>
<th>First</th>
<th>Middle</th>
<th>Ext</th>
<th>Birthdate</th>
<th>Age</th>
<th>Place</th>
<th>Sex</th>
<th>Status</th>
<th>Mother</th>
<th>Religion</th>
<th>Occupation</th>
<th>Income</th>
<th>ID Card</th>
<th>ID Number</th>
<th>Contact</th>

<th>House</th>
<th>Street</th>
<th>Sitio</th>
<th>Brgy Addr</th>
<th>City</th>
<th>Province Addr</th>
<th>Zip</th>

<th>4ps</th>
<th>IP</th>

<th>Bank</th>
<th>Account Name</th>
<th>Account Type</th>
<th>Account No</th>

<th>Ownership</th>
<th>Damage</th>
<th>Date Registered</th>
<th>Created</th>

<th>Family Member Name</th>
<th>Relation</th>
<th>Birthdate</th>
<th>Age</th>
<th>Sex</th>
<th>Education</th>
<th>Occupation</th>
<th>Vulnerability</th>

</tr>";



$sql = "SELECT * FROM beneficiaries WHERE 1=1";

$params = [];


if ($barangay != "") {
    $sql .= " AND addr_barangay LIKE ?";
    $params[] = "%$barangay%";
}

if ($search != "") {
    $sql .= " AND (
        last_name LIKE ?
        OR first_name LIKE ?
        OR middle_name LIKE ?
        OR contact_number LIKE ?
    )";

    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$sql .= " ORDER BY id DESC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);


$beneficiaries = $stmt->fetchAll(PDO::FETCH_ASSOC);



foreach ($beneficiaries as $b) {

echo "<tr>

<td>{$b['id']}</td>
<td>{$b['region']}</td>
<td>{$b['province']}</td>
<td>{$b['municipality']}</td>
<td>{$b['district']}</td>
<td>{$b['barangay']}</td>
<td>{$b['evacuation_site']}</td>

<td>{$b['last_name']}</td>
<td>{$b['first_name']}</td>
<td>{$b['middle_name']}</td>
<td>{$b['name_ext']}</td>
<td>{$b['birthdate']}</td>
<td>{$b['age']}</td>
<td>{$b['place_of_birth']}</td>
<td>{$b['sex']}</td>
<td>{$b['civil_status']}</td>
<td>{$b['mothers_maiden_name']}</td>
<td>{$b['religion']}</td>
<td>{$b['occupation']}</td>
<td>{$b['monthly_income']}</td>
<td>{$b['id_card_presented']}</td>
<td>{$b['id_number']}</td>
<td>{$b['contact_number']}</td>

<td>{$b['house_no']}</td>
<td>{$b['street']}</td>
<td>{$b['sitio']}</td>
<td>{$b['addr_barangay']}</td>
<td>{$b['addr_city']}</td>
<td>{$b['addr_province']}</td>
<td>{$b['zip_code']}</td>

<td>{$b['is_4ps']}</td>
<td>{$b['ip_type']}</td>

<td>{$b['bank_wallet']}</td>
<td>{$b['account_name']}</td>
<td>{$b['account_type']}</td>
<td>{$b['account_number']}</td>

<td>{$b['ownership']}</td>
<td>{$b['damage_classification']}</td>
<td>{$b['date_registered']}</td>
<td>{$b['created_at']}</td>

<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

</tr>";



$fam = $conn->prepare("
SELECT * FROM family_members
WHERE beneficiary_id = ?
");

$fam->execute([$b["id"]]);

$family = $fam->fetchAll(PDO::FETCH_ASSOC);



foreach ($family as $f) {

echo "<tr>

<td colspan='40'></td>

<td>{$f['name']}</td>
<td>{$f['relation']}</td>
<td>{$f['birthdate']}</td>
<td>{$f['age']}</td>
<td>{$f['sex']}</td>
<td>{$f['education']}</td>
<td>{$f['occupation']}</td>
<td>{$f['vulnerability']}</td>

</tr>";

}


echo "<tr><td colspan='48'></td></tr>";

}


echo "</table>";
?>