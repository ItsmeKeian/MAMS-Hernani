<?php

session_start();

require "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // LOCATION
    $region = $_POST["region"];
    $province = $_POST["province"];
    $municipality = $_POST["municipality"];
    $barangay = $_POST["barangay"];
    $district = $_POST["district"];
    $evacuation = $_POST["evacuation"];

    // HEAD
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


    // ADDRESS
    $house_no = $_POST["house_no"];
    $street = $_POST["street"];
    $sitio = $_POST["sitio"];
    $addr_barangay = $_POST["addr_barangay"];
    $addr_city = $_POST["addr_city"];
    $addr_province = $_POST["addr_province"];
    $zip_code = $_POST["zip_code"];


    // OTHERS
    $is_4ps = isset($_POST["is_4ps"]) ? 1 : 0;
    $ip_type = $_POST["ip_type"];


    // ACCOUNT
    $bank_wallet = $_POST["bank"];
    $account_name = $_POST["account_name"];
    $account_type = $_POST["account_type"];
    $account_number = $_POST["account_number"];


    // HOUSE
    $ownership = $_POST["ownership"];
    $damage = $_POST["damage"];


    // DATE
    $date_registered = $_POST["date_registered"];


    $sql = "

    INSERT INTO beneficiaries (

        region, province, municipality, barangay, district, evacuation_site,

        last_name, first_name, middle_name, name_ext,
        birthdate, age, place_of_birth,
        sex, civil_status,
        mothers_maiden_name, religion, occupation,
        monthly_income,
        id_card_presented, id_number,
        contact_number,

        house_no, street, sitio,
        addr_barangay, addr_city, addr_province, zip_code,

        is_4ps, ip_type,

        bank_wallet, account_name, account_type, account_number,

        ownership, damage_classification,

        date_registered

    )

    VALUES (

        ?,?,?,?,?,?,

        ?,?,?,?,
        ?,?,?,
        ?,?,
        ?,?,?,
        ?,
        ?,?,
        ?,

        ?,?,?,
        ?,?,?,?,

        ?,?,

        ?,?,?,?,

        ?,?,

        ?

    )

    ";


    $stmt = $conn->prepare($sql);

    $stmt->execute([

        $region,
        $province,
        $municipality,
        $barangay,
        $district,
        $evacuation,

        $last_name,
        $first_name,
        $middle_name,
        $name_ext,

        $birthdate,
        $age,
        $place_of_birth,

        $sex,
        $civil_status,

        $mothers_maiden_name,
        $religion,
        $occupation,

        $monthly_income,

        $id_card_presented,
        $id_number,

        $contact_number,

        $house_no,
        $street,
        $sitio,

        $addr_barangay,
        $addr_city,
        $addr_province,
        $zip_code,

        $is_4ps,
        $ip_type,

        $bank_wallet,
        $account_name,
        $account_type,
        $account_number,

        $ownership,
        $damage,

        $date_registered

    ]);


    // get last id
    $id = $conn->lastInsertId();

    header("Location: ../view_beneficiary.php?id=" . $id);
    exit();

}