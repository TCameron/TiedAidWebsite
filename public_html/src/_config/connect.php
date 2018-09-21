<?php
/**
 * Created by PhpStorm.
 * User: tcameron
 * Date: 7/20/2016
 * Time: 14:31
 */
$servername = "";
$username = "";
$password = "";
$dbname = "";
// Create Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
