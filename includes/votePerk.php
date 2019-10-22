<?php
session_start();
require_once("connection.php");

$perkId = $_POST['perkId'];
$vote = $_POST['vote'];

$sql = 'SELECT * FROM ' . strtolower($_SESSION['category']) . 'perk WHERE Id = ' . $perkId;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$obj = $stmt->fetchObject();

$perkName = addslashes(trim($obj->Name));

$sql1 = 'SELECT * FROM account_voted_on WHERE username LIKE "' . $_SESSION['username'] . '" AND perk LIKE "' . $perkName . '";';
$stmt1 = $dbh->prepare($sql1);
$stmt1->execute();
$obj1 = $stmt1->fetchObject();

if ($obj1) {
    $sql2 = 'UPDATE account_voted_on SET vote = "' . $vote . '" WHERE username LIKE "' . $_SESSION['username'] . '" AND perk LIKE "' . $perkName . '";';
} else {
    $sql2 = 'INSERT INTO account_voted_on(username, perk, vote) VALUES ("' . $_SESSION['username'] . '", "' . $perkName . '", "' . $vote . '")';
}

$stmt2 = $dbh->prepare($sql2);
$stmt2->execute();

require_once("updatePerkRatings.php");
require_once("updateSurvivorRatings.php");

// echo $sql, '||', $perkName, '||', $sql1, '||', $sql2;
