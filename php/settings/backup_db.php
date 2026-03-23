<?php

$db = "mamshernani";

$backupDir = __DIR__ . "/../backup/";

if (!is_dir($backupDir)) {
    mkdir($backupDir, 0777, true);
}

$filename = $backupDir . "backup_" . date("Y-m-d_H-i-s") . ".sql";

$mysqldump = "C:/xampp/mysql/bin/mysqldump";

$command = "\"$mysqldump\" --user=root $db > \"$filename\"";

system($command);

echo "ok";