<?php
session_start();
if (($_SESSION["category"]) == "Survivor") {
    $_SESSION["category"] = "Killer";
    $_SESSION["otcategory"] = "Survivor";
} elseif (($_SESSION["category"]) == "Killer") {
    $_SESSION["category"] = "Survivor";
    $_SESSION["otcategory"] = "Killer";
}

echo basename($_SERVER['HTTP_REFERER']);

if (basename($_SERVER['HTTP_REFERER']) == "killers.php") {
    header("Location: " . "../survivors.php");
} elseif (basename($_SERVER['HTTP_REFERER']) == "survivors.php") {
    header("Location: " . "../killers.php");
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

die();
