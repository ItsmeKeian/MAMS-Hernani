<?php

require "../dbconnect.php";
require "../logs.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $id = $_POST["id"];


    // ========================
    // BENEFICIARY DATA
    // ========================

    $region = $_POST["region"];
    $province = $_POST["province"];
    $municipality = $_POST["municipality"];
    $barangay = $_POST["barangay"];
    $district = $_POST["district"];
    $evacuation = $_POST["evacuation"];

    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $name_ext = $_POST["name_ext"];

    $birthdate = $_POST["birthdate"];
    $age = $_POST["age"];
    $place_of_birth = $_POST["place_of_birth"];

    $sex = $_POST["sex"];
    $civil_status = $_POST["civil_status"];

    $mothers_maiden_name = $_POST["mothers_maiden_name"];
    $religion = $_POST["religion"];
    $occupation = $_POST["occupation"];

    $monthly_income = $_POST["monthly_income"];

    $id_card_presented = $_POST["id_card_presented"];
    $id_number = $_POST["id_number"];

    $contact_number = $_POST["contact_number"];

    $house_no = $_POST["house_no"];
    $street = $_POST["street"];
    $sitio = $_POST["sitio"];
    $addr_barangay = $_POST["addr_barangay"];
    $addr_city = $_POST["addr_city"];
    $addr_province = $_POST["addr_province"];
    $zip_code = $_POST["zip_code"];

    $is_4ps = isset($_POST["is_4ps"]) ? 1 : 0;
    $ip_type = $_POST["ip_type"];

    $bank = $_POST["bank"];
    $account_name = $_POST["account_name"];
    $account_type = $_POST["account_type"];
    $account_number = $_POST["account_number"];

    $ownership = $_POST["ownership"] ?? null;
    $damage = $_POST["damage"] ?? null;

    $date_registered = $_POST["date_registered"];


    // ========================
    // UPDATE BENEFICIARY
    // ========================

    $sql = "

    UPDATE beneficiaries SET

    region=?,
    province=?,
    municipality=?,
    barangay=?,
    district=?,
    evacuation_site=?,

    last_name=?,
    first_name=?,
    middle_name=?,
    name_ext=?,

    birthdate=?,
    age=?,
    place_of_birth=?,

    sex=?,
    civil_status=?,

    mothers_maiden_name=?,
    religion=?,
    occupation=?,

    monthly_income=?,
    id_card_presented=?,
    id_number=?,
    contact_number=?,

    house_no=?,
    street=?,
    sitio=?,
    addr_barangay=?,
    addr_city=?,
    addr_province=?,
    zip_code=?,

    is_4ps=?,
    ip_type=?,

    bank_wallet=?,
    account_name=?,
    account_type=?,
    account_number=?,

    ownership=?,
    damage_classification=?,

    date_registered=?

    WHERE id=?

    ";

    $stmt = $conn->prepare($sql);

    $stmt->execute([

        $region,$province,$municipality,$barangay,$district,$evacuation,

        $last_name,$first_name,$middle_name,$name_ext,
        $birthdate,$age,$place_of_birth,

        $sex,$civil_status,

        $mothers_maiden_name,$religion,$occupation,

        $monthly_income,
        $id_card_presented,$id_number,$contact_number,

        $house_no,$street,$sitio,
        $addr_barangay,$addr_city,$addr_province,$zip_code,

        $is_4ps,$ip_type,

        $bank,$account_name,$account_type,$account_number,

        $ownership,$damage,

        $date_registered,

        $id

    ]);


    // ========================
    // DELETE OLD FAMILY
    // ========================

    $delFam = $conn->prepare("
    DELETE FROM family_members
    WHERE beneficiary_id = ?
    ");

    $delFam->execute([$id]);


    // ========================
    // INSERT FAMILY
    // ========================

    if (isset($_POST["fm_name"])) {

        $names = $_POST["fm_name"];
        $relations = $_POST["fm_relation"];
        $birthdates = $_POST["fm_birthdate"];
        $ages = $_POST["fm_age"];
        $sex = $_POST["fm_sex"];
        $education = $_POST["fm_education"];
        $occupation = $_POST["fm_occupation"];
        $vulnerability = $_POST["fm_vulnerability"];

        for ($i=0;$i<count($names);$i++) {

            if ($names[$i]=="") continue;

            $sql2 = "

            INSERT INTO family_members
            (
                beneficiary_id,
                name,
                relation,
                birthdate,
                age,
                sex,
                education,
                occupation,
                vulnerability
            )

            VALUES (?,?,?,?,?,?,?,?,?)

            ";

            $stmt2 = $conn->prepare($sql2);

            $stmt2->execute([

                $id,
                $names[$i],
                $relations[$i],
                $birthdates[$i],
                $ages[$i],
                $sex[$i],
                $education[$i],
                $occupation[$i],
                $vulnerability[$i]

            ]);

        }

    }


    // ========================
    // DELETE OLD ASSISTANCE
    // ========================

    $delAid = $conn->prepare("
    DELETE FROM assistance_records
    WHERE beneficiary_id = ?
    ");

    $delAid->execute([$id]);


    // ========================
    // INSERT ASSISTANCE
    // ========================

    if (isset($_POST["aid_date"])) {

        $dates = $_POST["aid_date"];
        $receiving = $_POST["aid_receiving"];
        $disaster = $_POST["aid_disaster"];
        $type = $_POST["aid_type"];
        $unit = $_POST["aid_unit"];
        $qty = $_POST["aid_qty"];
        $cost = $_POST["aid_cost"];
        $provider = $_POST["aid_provider"];

        for ($i=0;$i<count($dates);$i++) {

            if ($dates[$i]=="") continue;

            $sql3 = "

            INSERT INTO assistance_records
            (
                beneficiary_id,
                date_received,
                receiving_name,
                disaster_type,
                assistance_type,
                unit,
                quantity,
                cost,
                provider
            )

            VALUES (?,?,?,?,?,?,?,?,?)

            ";

            $stmt3 = $conn->prepare($sql3);

            $stmt3->execute([

                $id,
                $dates[$i],
                $receiving[$i],
                $disaster[$i],
                $type[$i],
                $unit[$i],
                $qty[$i],
                $cost[$i],
                $provider[$i]

            ]);

        }

    }


    // ========================
    // LOG
    // ========================

    addLog(
        "update",
        "beneficiary",
        "Updated beneficiary: ".$first_name." ".$last_name
    );


    echo json_encode([
        "status" => 1
    ]);

}