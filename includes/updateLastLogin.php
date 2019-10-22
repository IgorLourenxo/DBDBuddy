<?php
require_once("connection.php");
$username = $_SESSION['username'];

$sql = 'UPDATE account SET lastLogin = "' . date("Y-m-d H:i:s") . '" WHERE username LIKE "' . $username . '";';
$stmt = $dbh->prepare($sql);
$stmt->execute();
