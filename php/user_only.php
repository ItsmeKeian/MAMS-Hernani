<?php

require "auth.php";

if ($_SESSION["role"] != "user") {

    echo "Access denied";
    exit;

}