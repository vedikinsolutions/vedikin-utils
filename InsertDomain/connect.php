<?php
$host_name="thcitsolutions.com";
$user_name="thcitsolutions_usrtool";
$password="%ca4O{Lvno;i";
$db_name="thcitsolutions_thcitsol_thctools";

$conn = new mysqli($host_name, $user_name, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>