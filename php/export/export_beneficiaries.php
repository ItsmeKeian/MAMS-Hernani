<?php

require "../dbconnect.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=beneficiaries.xls");

$stmt = $conn->prepare("
    SELECT * FROM beneficiaries
    ORDER BY id DESC
");

$stmt->execute();

echo "<table border='1'>";

echo "<tr>
<th>ID</th>
<th>Region</th>
<th>Province</th>
<th>Municipality</th>
<th>District</th>
<th>Barangay</th>
<th>Evacuation</th>
<th>Last Name</th>
<th>First Name</th>
<th>Middle Name</th>
<th>Name Ext</th>
<th>Birthdate</th>
<th>Age</th>
<th>Place of Birth</th>
<th>Sex</th>
<th>Civil Status</th>
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
<th>Barangay Addr</th>
<th>City</th>
<th>Province Addr</th>
<th>Zip</th>
<th>4ps</th>
<th>IP Type</th>
<th>Bank</th>
<th>Account Name</th>
<th>Account Type</th>
<th>Account Number</th>
<th>Ownership</th>
<th>Damage</th>
<th>Date Registered</th>
</tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    echo "<tr>
    
    <td>{$row['id']}</td>
    <td>{$row['region']}</td>
    <td>{$row['province']}</td>
    <td>{$row['municipality']}</td>
    <td>{$row['district']}</td>
    <td>{$row['barangay']}</td>
    <td>{$row['evacuation_site']}</td>
    <td>{$row['last_name']}</td>
    <td>{$row['first_name']}</td>
    <td>{$row['middle_name']}</td>
    <td>{$row['name_ext']}</td>
    <td>{$row['birthdate']}</td>
    <td>{$row['age']}</td>
    <td>{$row['place_of_birth']}</td>
    <td>{$row['sex']}</td>
    <td>{$row['civil_status']}</td>
    <td>{$row['mothers_maiden_name']}</td>
    <td>{$row['religion']}</td>
    <td>{$row['occupation']}</td>
    <td>{$row['monthly_income']}</td>
    <td>{$row['id_card_presented']}</td>
    <td>{$row['id_number']}</td>
    <td>{$row['contact_number']}</td>
    <td>{$row['house_no']}</td>
    <td>{$row['street']}</td>
    <td>{$row['sitio']}</td>
    <td>{$row['addr_barangay']}</td>
    <td>{$row['addr_city']}</td>
    <td>{$row['addr_province']}</td>
    <td>{$row['zip_code']}</td>
    <td>{$row['is_4ps']}</td>
    <td>{$row['ip_type']}</td>
    <td>{$row['bank_wallet']}</td>
    <td>{$row['account_name']}</td>
    <td>{$row['account_type']}</td>
    <td>{$row['account_number']}</td>
    <td>{$row['ownership']}</td>
    <td>{$row['damage_classification']}</td>
    <td>{$row['date_registered']}</td>
    
    </tr>";
    
    }

echo "</table>";

?>