<?php

require "../dbconnect.php";
require "../logs.php";


$search   = $_GET["search"] ?? "";
$barangay = $_GET["barangay"] ?? "";
$damage   = $_GET["damage"] ?? "";
$from     = $_GET["from"] ?? "";
$to       = $_GET["to"] ?? "";


// ================= LOG =================

$details = "Exported beneficiaries";

if ($barangay != "") $details .= " | Brgy: $barangay";
if ($damage != "") $details .= " | Damage: $damage";
if ($search != "") $details .= " | Search: $search";
if ($from != "" && $to != "") $details .= " | Date: $from to $to";

addLog("export", "beneficiaries", $details);


// ================= FILENAME =================

$filename = "beneficiaries.xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");


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

<th>Family Name</th>
<th>Relation</th>
<th>Birthdate</th>
<th>Age</th>
<th>Sex</th>
<th>Education</th>
<th>Occupation</th>
<th>Vulnerability</th>

<th>Date Received</th>
<th>Receiver</th>
<th>Disaster</th>
<th>Assistance</th>
<th>Unit</th>
<th>Qty</th>
<th>Cost</th>
<th>Provider</th>

</tr>";


// ================= SQL WITH FILTER =================

$sql = "SELECT * FROM beneficiaries WHERE 1=1";
$params = [];

if ($search != "") {
    $sql .= " AND CONCAT(first_name,' ',last_name) LIKE ?";
    $params[] = "%$search%";
}

if ($barangay != "") {
    $sql .= " AND addr_barangay LIKE ?";
    $params[] = "%$barangay%";
}

if ($damage != "") {
    $sql .= " AND damage_classification LIKE ?";
    $params[] = "%$damage%";
}

if ($from != "" && $to != "") {
    $sql .= " AND date_registered BETWEEN ? AND ?";
    $params[] = $from;
    $params[] = $to;
}

$sql .= " ORDER BY id DESC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);

$beneficiaries = $stmt->fetchAll(PDO::FETCH_ASSOC);


// ================= LOOP =================

foreach ($beneficiaries as $b) {

    $fam = $conn->prepare("
        SELECT *
        FROM family_members
        WHERE beneficiary_id = ?
    ");
    $fam->execute([$b["id"]]);
    $family = $fam->fetchAll(PDO::FETCH_ASSOC);


    $assist = $conn->prepare("
        SELECT *
        FROM assistance_records
        WHERE beneficiary_id = ?
        ORDER BY date_received ASC
    ");
    $assist->execute([$b["id"]]);
    $assistance = $assist->fetch(PDO::FETCH_ASSOC);


    // ================= WITH FAMILY =================

    if (!empty($family)) {

        $first = true;

        foreach ($family as $f) {

            echo "<tr>";

            if ($first) {

                echo "

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

";

            } else {

                echo str_repeat("<td></td>", 40);

            }


            echo "

<td>{$f['name']}</td>
<td>{$f['relation']}</td>
<td>{$f['birthdate']}</td>
<td>{$f['age']}</td>
<td>{$f['sex']}</td>
<td>{$f['education']}</td>
<td>{$f['occupation']}</td>
<td>{$f['vulnerability']}</td>

";


            if ($first && $assistance) {

                echo "

<td>{$assistance['date_received']}</td>
<td>{$assistance['receiving_name']}</td>
<td>{$assistance['disaster_type']}</td>
<td>{$assistance['assistance_type']}</td>
<td>{$assistance['unit']}</td>
<td>{$assistance['quantity']}</td>
<td>{$assistance['cost']}</td>
<td>{$assistance['provider']}</td>

";

            } else {

                echo str_repeat("<td></td>", 8);

            }

            echo "</tr>";

            $first = false;

        }

    }

    // ================= NO FAMILY =================

    else {

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

<td></td><td></td><td></td><td></td>
<td></td><td></td><td></td><td></td>

<td>".($assistance['date_received'] ?? '')."</td>
<td>".($assistance['receiving_name'] ?? '')."</td>
<td>".($assistance['disaster_type'] ?? '')."</td>
<td>".($assistance['assistance_type'] ?? '')."</td>
<td>".($assistance['unit'] ?? '')."</td>
<td>".($assistance['quantity'] ?? '')."</td>
<td>".($assistance['cost'] ?? '')."</td>
<td>".($assistance['provider'] ?? '')."</td>

</tr>";

    }

}
echo "</table>";