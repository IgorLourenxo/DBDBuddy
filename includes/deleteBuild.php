<?php
session_start();
require_once("connection.php");

$buildId = $_POST['buildId'];

$sql1 = 'SELECT * FROM builds WHERE id = ' . $buildId;
$stmt1 = $dbh->prepare($sql1);
$stmt1->execute();
$obj1 = $stmt1->fetchObject();

$sql = 'UPDATE ' . strtolower($_SESSION['category']) . 'perk SET Used = Used -1 WHERE Name = "' . $obj1->perk1 . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$sql = 'UPDATE ' . strtolower($_SESSION['category']) . 'perk SET Used = Used -1 WHERE Name = "' . $obj1->perk2 . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$sql = 'UPDATE ' . strtolower($_SESSION['category']) . 'perk SET Used = Used -1 WHERE Name = "' . $obj1->perk3 . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$sql = 'UPDATE ' . strtolower($_SESSION['category']) . 'perk SET Used = Used -1 WHERE Name = "' . $obj1->perk4 . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$sql = 'UPDATE account SET buildsCreated = buildsCreated -1 WHERE username LIKE  "' . $obj1->createdBy . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$sql = 'DELETE FROM builds WHERE id = ' . $buildId;
$stmt = $dbh->prepare($sql);
$stmt->execute();

require_once("updatePerkRatings.php");
require_once("updateSurvivorRatings.php");