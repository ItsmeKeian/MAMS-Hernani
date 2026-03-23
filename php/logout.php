<?php

session_start();

require "logs.php";

addLog(
    "logout",
    "authentication",
    "User logged out"
);

session_destroy();

header("Location: ../index.html");

?>