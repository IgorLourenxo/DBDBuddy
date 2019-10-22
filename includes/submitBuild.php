<?php
session_start();
require_once("connection.php");

$perk1 = $_POST['perk1'];
$perk2 = $_POST['perk2'];
$perk3 = $_POST['perk3'];
$perk4 = $_POST['perk4'];
$character = $_POST['character'];
$category = $_SESSION["category"];
$miniDescription = $_POST["miniDescription"];
$fullDescription = $_POST["fullDescription"];
if ($_POST['buildName']) {
    $buildName = $_POST['buildName'];
} else {
    if (isset($_SESSION['username'])) {
        if ($category == "Survivor") {
            $buildName = $_SESSION['username'] . "'s " . $character . " Build";
        } elseif ($category = "Killer") {
            $buildName = $_SESSION['username'] . "'s The " . $character . " Build";
        }
    } else {
        $buildname = "[not named]";
    }
};

$sql = 'INSERT INTO builds (perk1, perk2, perk3, perk4, buildCharacter, category, buildName, createdBy, createdAt, miniDescription, fullDescription) 
VALUES ("' . $perk1 . '", "' . $perk2 . '", "' . $perk3 . '", "' . $perk4 . '", "' . $character . '", "' . $category . '", "' . $buildName . '", "' . $_SESSION['username'] . '", "' . date("Y-m-d H:i:s") . '", "' . $miniDescription . '", "' . $fullDescription . '")';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$sql = 'UPDATE account SET buildsCreated = buildsCreated +1 WHERE username LIKE  "' . $_SESSION['username'] . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$sql = 'UPDATE ' . strtolower($category) . 'perk SET Used = Used +1 WHERE Name = "' . $perk1 . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$sql = 'UPDATE ' . strtolower($category) . 'perk SET Used = Used +1 WHERE Name = "' . $perk2 . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$sql = 'UPDATE ' . strtolower($category) . 'perk SET Used = Used +1 WHERE Name = "' . $perk3 . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$sql = 'UPDATE ' . strtolower($category) . 'perk SET Used = Used +1 WHERE Name = "' . $perk4 . '"';
$stmt = $dbh->prepare($sql);
$stmt->execute();

echo "Your build <strong>" . $buildName . "</strong> was saved successfully!";

require_once("updatePerkRatings.php");
require_once("updateSurvivorRatings.php");