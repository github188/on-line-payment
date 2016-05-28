<?php
require_once("config.php");

function db_connect() {
    global $DB_HOST;
    global $DB_USER;
    global $DB_PASSWORD;
    global $DB_SCHEMA;
    global $DB_PORT;
    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_SCHEMA, $DB_PORT);
    if (!$conn) {
        die('could not connect: ' . mysqli_error($conn));
    }
    mysqli_query($conn, "set character set 'utf8'");
    mysqli_query($conn, "set names 'utf8'");

    return $conn;
}
