<?php
require_once("connection.php");

$sql = 'SELECT * 
FROM ' . strtolower($_SESSION['category']) . 'perk;';
$stmt = $dbh->prepare($sql);
$stmt->execute();

while ($obj = $stmt->fetchObject()) {

    // echo '<h1>*', trim($obj->Name), '*</h1>';
    // echo '<h2>Before updates:</h2>';
    // echo 'Votes: ', $obj->Votes, '<br>';
    // echo 'Used: ', $obj->Used, '<br>';
    // echo 'Ranking: ', $obj->Ranking, '<br><br>';

    $sql1 = 'SELECT *
    FROM account_voted_on
    WHERE perk =  "' . trim($obj->Name) . '";';
    $stmt1 = $dbh->prepare($sql1);
    $stmt1->execute();

    $total = 0;
    $newRanking = 0;

    while ($obj1 = $stmt1->fetchObject()) {
        if ($obj1->vote) {
            $total = $total + 1;
        } elseif (!$obj1->vote) {
            $total = $total - 1;
        }
    }
    // echo '<h2>During updates:</h2>';
    // echo $sql1, '<br>';
    // echo 'Votes: <strong>', $total, '</strong><br>';
    // echo 'Used: <strong>', $obj->Used, '</strong><br>';
    $newRanking = $total + (number_format((double)($obj->Used * 0.5), 2, '.', ''));
    // echo 'Ranking: <strong>', $obj->Ranking, '</strong> -> <strong>', $newRanking, '</strong> <br><br>';

    $sql3 = 'UPDATE ' . strtolower($_SESSION['category']) . 'perk 
    SET 
    Ranking = ' . $newRanking . ',
    Votes = ' . $total . ',
    Used = ' . $obj->Used . '
    WHERE Name LIKE  "' . $obj->Name . '";';
    $stmt3 = $dbh->prepare($sql3);
    $stmt3->execute();

    // echo $sql3;
}
