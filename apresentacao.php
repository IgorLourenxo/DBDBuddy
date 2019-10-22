<?php session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="wVhFqf4MEJaribsakj6m7uDpiDEpEm-Pdx0bdAvrbGg" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Website favicon -->
    <link rel="icon" href="imagens/favicon.png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Debugger CSS -->
    <!-- <link rel="stylesheet" href="css/debugger.css"> -->

    <title>Dead by Daylight Buddy - Presentation</title>
</head>

<body class="apresentacao">
    <?php require_once("includes/connection.php") ?>

    <div class="container bg-dark pt-3 pb-3">
        <div class="display-1 text-center h1 rounded bg-light m-0 sm">PRESENTATION DAY!</div>

        <div class="container bg-light rounded mt-3 pb-3">
            <div class="text-center border-bottom" style="font-size: 2.5rem;">
                Presenting <strong>Dead by Daylight Buddy</strong>.
            </div>
            <p>
                <strong>Dead by Daylight Buddy</strong> is a web plataform that allows players from Dead by Daylight community to interact with each other, sharing their ideas for builds and different playstyles!
            </p>
            <p class="text-center">
                When you access <strong>www.deadbydaylightbuddy.com</strong> you will be presented by the <strong>main page</strong>.
                <br>
                <div class="lead">What can we find there?</div>
                <ul>
                    <li>Basic information.</li>
                    <li>What is <strong>DBD Buddy</strong>?</li>
                    <li>A list of the last connected users.<strong>*</strong></li>
                </ul>

                <div class="container">
                    <div class="rounded-top bg-white">
                        <div class="text-dark text-center h3 m-0 p-2">Last Users Connected</div>
                    </div>
                    <div class="rounded-bottom bg-dark mb-4 text-white">
                        <div class="row pt-2">
                            <?php
                            $sql = 'SELECT * FROM account ORDER BY lastLogin DESC';
                            $stmt = $dbh->prepare($sql);
                            $stmt->execute();
                            while ($obj = $stmt->fetchObject()) {
                                ?>
                                <div class="col-12 row">
                                    <div class="col-2 border offset-1 text-center"><?= $obj->username ?></div>
                                    <div class="col-3">Last login:
                                        <strong>
                                            <?php
                                            $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($obj->lastLogin);

                                            $months = floor($seconds / (3600 * 24 * 30));
                                            $day = floor($seconds / (3600 * 24));
                                            $hours = floor($seconds / 3600);
                                            $mins = floor(($seconds - ($hours * 3600)) / 60);
                                            $secs = floor($seconds % 60);

                                            if ($seconds < 60)
                                                $time = $secs . " seconds ago";
                                            else if ($seconds < 60 * 60)
                                                $time = $mins . " minutes ago";
                                            else if ($seconds < 24 * 60 * 60)
                                                $time = $hours . " hours ago";
                                            else if ($seconds < 24 * 60 * 60 * 30)
                                                $time = $day . " days ago";
                                            else
                                                $time = $months . " months ago";

                                            if ($seconds == 0)
                                                echo "Right now!";
                                            else
                                                echo $time;
                                            ?>
                                        </strong>
                                    </div>
                                    <div class="col-2 border text-center">Created <strong><?= $obj->buildsCreated ?></strong> builds</div>
                                    <div class="col-3 text-center">Voted on
                                        <strong>
                                            <?php
                                            $sql1 = "SELECT * FROM account_voted_on WHERE username LIKE '" . $obj->username . "';";
                                            $stmt1 = $dbh->prepare($sql1);
                                            $stmt1->execute();
                                            $perksVoted = 0;
                                            while ($obj1 = $stmt1->fetchObject()) {
                                                $perksVoted = $perksVoted + 1;
                                            }
                                            echo trim($perksVoted); ?></strong>/122 perks
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <p><strong>*</strong> Like this!</p>
                <p class="lead text-center">But how do we do that?</p>
                <span>In PHP, we access our database by connecting it beforehand like so:
                    <li class="font-weight-bold">$dbh = new PDO('mysql:host=localhost; dbname=deadbyda_dbdbuddy; charset=utf8', 'deadbyda_kijiroshi', '[PASSWORD, NOT REVEALED]');</li>
                    And then we select everything from our table <strong>account</strong>:
                    <li class="font-weight-bold">$sql = 'SELECT * FROM account ORDER BY lastLogin DESC';</li>
                    And then, we print it:
                    <li class="font-weight-bold">$stmt = $dbh->prepare($sql);
                        <br>
                        $stmt->execute();
                        <br>
                        while ($obj = $stmt->fetchObject()) {</li>
                    Everytime a user logs in, they get redirected to our <strong>index.php</strong>, where we have a PHP that's very important.
                    <li class="font-weight-bold">require_once("updateLastLogin.php");</li>
                    This will print a file where we, in PHP, update the database putting the current time in the <strong>lastLogin</strong> column from our <strong>account</strong> table. Then, we do math!
                    <li class="font-weight-bold">$seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($obj->lastLogin);</li>
                    If $seconds is actually less than 60 seconds, it will show as "Last login: X seconds ago". If it's more than 60 seconds but less than 1 hour (3600), then it will show as "Last login: X minutes ago", and so on.
                </span>
                <a href="login.php" target="_blank" rel="noopener noreferrer" class="btn btn-info">Let's try it!</a>
                <div class="lead text-center">Then what?</div>
                <p>Now, we can:</p>
                <ul>
                    <li>Get information on all characters avaible.</li>
                    <a target="_blank" rel="noopener noreferrer" href="survivors.php" class="btn btn-success">Survivor List</a>
                    <a target="_blank" rel="noopener noreferrer" href="killers.php" class="btn btn-danger">Killer List</a>
                    <li>Check each character ranking.</li>
                    <li>Get information on all perks avaible.</li>
                    <a target="_blank" rel="noopener noreferrer" href="perkList.php" class="btn btn-warning">Perk List</a>
                    <li>Create our own build.</li>
                    <a target="_blank" rel="noopener noreferrer" href="buildCreator.php" class="btn btn-info">Build Creator</a>
                    <li>Check other user's builds and their rankings.</li>
                    <a target="_blank" rel="noopener noreferrer" href="buildList.php" class="btn btn-dark">Build List</a>
                </ul>
                <div class="lead text-center">How accurate are the rankings?</div>
                <p>Rankings are made by different methods.</p>
                <ul>
                    <li>Perks rankings: They're based on effect. Voted by the community. Their ranking is equal to the votes + half of the times they're used.</li>
                    <li>Killer rankings: They're based on their unique power. Voted by the community.</li>
                    <li>Survivor rankings: As they are only cosmetics, they are based on their teachables rankings.</li>
                    <li>Build rankings: They are based on the community's votes.</li>
                </ul>
                <div class="text-center lead">How does the database get affected?</div>
                Our database is the main point of our website. Without it, it wouldn't work at all. It gets affected when:
                <ul>
                    <li>(Admin only) A new survivor is added.</li>
                    <li>(Admin only) A new killer is added.</li>
                    <li>(Admin only) A new perk is added.</li>
                    <li>A new build is created.</li>
                    <li>A new account is registered.</li>
                    <li>A new vote is inserted.</li>
                    <li>An old vote is updated.</li>
                    <li>A build gets deleted.</li>
                    <li>An account is accessed.</li>
                </ul>
                <img src="imagens/presentation/databaseTables.PNG" class="w-100">
                <p>For instance, our <strong>survivorperk</strong> table has all information of the perks from the survivor category. It looks something like this:</p>
                <div class="text-center">
                    <img src="imagens/presentation/databaseSurvivorPerk.PNG" class="w-75">
                </div>
                <p>So, when we create a new build, it gets added to the table <strong>builds</strong>. What information do we store?</p>
                <div class="text-center">
                    <img src="imagens/presentation/databaseBuildRow.PNG" class="w-100">
                </div>
                <div class="lead text-center">But how?</div>
                <div class="text-center">
                    <a target="_blank" rel="noopener noreferrer" href="buildCreator.php" class="btn btn-info">Check for yourselves!</a>
                </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- None -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>