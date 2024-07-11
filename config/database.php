<?php 
require_once dirname(__DIR__, 2) . '/WCF_Coding_Challenge/config.php';

$serverName = $_ENV['DB_SERVERNAME'];
$connectionOptions = array(
    "Database" => $_ENV['DB_DATABASE'],
    "Uid" => $_ENV['DB_USERNAME'],
    "PWD" => $_ENV['DB_PASSWORD']
);
function getDatabaseConnection() {
    global $serverName, $connectionOptions;
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    return $conn;
}
?>
