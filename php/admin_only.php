<?php

require "auth.php";

if ($_SESSION["role"] != "admin") {

    echo "Access denied";
    exit;

}