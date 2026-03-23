<?php

$folder = "../backup/";

$files = glob($folder . "*.sql");

echo count($files);