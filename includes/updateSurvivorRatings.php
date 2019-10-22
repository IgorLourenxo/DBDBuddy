<?php
require_once("connection.php");

$sql = 'SELECT * FROM survivor';
$stmt = $dbh->prepare($sql);
$stmt->execute();

while ($obj = $stmt->fetchObject()) {

    // echo '<h1>', $obj->name, '</h1>';

    $sql1 = 'SELECT *
    FROM survivorperk
    WHERE Survivor =  "' . $obj->name . '"';
    $stmt1 = $dbh->prepare($sql1);
    $stmt1->execute();
    

    $total = 0;

    while ($obj1 = $stmt1->fetchObject()) {
        // echo $obj1->Ranking, '<br>';
        $total = $total + $obj1->Ranking;
    }
    // echo 'Total: <strong>', $total, '</strong><br>';
    $rating = number_format((double)($total / 3), 2, '.', '');
    // echo $obj->name, "'s Rating: ", $rating;

    $sql3 = 'UPDATE survivor SET ranking = ' . $total . ' WHERE Name LIKE  "' . $obj->name . '"';
    $stmt3 = $dbh->prepare($sql3);
    $stmt3->execute();

    // echo '<br>', $sql3;
}


