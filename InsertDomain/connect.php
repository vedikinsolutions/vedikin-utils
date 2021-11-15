<?php
$host_name="localhost:3308";
$user_name="root";
$password="";
$db_name="test1";

$conn = new mysqli($host_name, $user_name, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>