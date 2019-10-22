<?php
try {
    $dbh = new PDO('mysql:host=localhost; dbname=database name; charset=utf8', 'username', 'password');
} catch (PDOException $e) {
    print "<div class='text-white'>Erro! : " . $e->getMessage() . "</div>";
    die();
}

date_default_timezone_set ('Europe/London');
