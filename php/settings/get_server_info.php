<?php

require "../dbconnect.php";

$data = [];

$data["php"] = phpversion();

$data["db"] = $conn->query("SELECT DATABASE()")->fetchColumn();

$data["mysql"] = $conn->query("SELECT VERSION()")->fetchColumn();

echo json_encode($data);