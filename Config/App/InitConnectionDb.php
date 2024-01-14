<?php
require_once(__DIR__ . '/../Config.php');
function initConnectionDB()
{
    $mysqli = new mysqli(
        DBHOST,
        DBUSER,
        DBPASS,
        DBNAME
    );
    if ($mysqli->connect_error) {
        die('Error connection: ' . $mysqli->connect_error);
    }
    return $mysqli;
}
?>