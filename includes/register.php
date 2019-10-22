<?php
session_start();
require_once("connection.php");

$username = $_POST['newUser'];
$email = $_POST['newEmail'];
$password = $_POST['newPass'];

$sqlCheck = 'SELECT * FROM account WHERE (email LIKE "' . $email . '" OR username LIKE "' . $username . '")';
$stmtCheck = $dbh->prepare($sqlCheck);
$stmtCheck->execute();
$objCheck = $stmtCheck->fetchObject();

if ($stmtCheck->rowCount() == 0) {
    $sql = 'INSERT INTO account(username, email, password, registeredAt) VALUES ("' . $username . '", "' . $email . '", "' . $password . '", now());';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $obj = $stmt->fetchObject();

    if ($stmt->rowCount()) {
        echo "Registered '", $username, "' with the password of '", $password, "' and email '", $email, "'.";
        $_SESSION['username'] = $username;
        header("Location: " . '../');
    }
} else {
    header("Location: " . '../login.php');
    $_SESSION['errorReg'] = "That username or email is already being used.";
};

die();
