<?php

require "../dbconnect.php";

$conn->query("DELETE FROM logs");

echo "ok";