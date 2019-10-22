<?php
session_start();
require_once("connection.php");

$username = $_POST['userLogin'];
$password = $_POST['passLogin'];

$sql = 'SELECT * FROM account WHERE username LIKE "' . $username . '" and password LIKE "' . $password . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$obj = $stmt->fetchObject();

if ($obj) {
    echo "Loged in as '", $obj->username, "' with the password of '", $obj->password, "'.";
    $_SESSION['username'] = $obj->username;
    header("Location: " . '../');
} else {
    header("Location: " . '../login.php');
    $_SESSION['error'] = "Invalid username or password.";
};

require_once("updateLastLogin.php");

die();
