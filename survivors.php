<?php session_start();

$_SESSION["category"] = "Survivor";
$_SESSION["otcategory"] = "Killer";

require_once("includes/connection.php");
if (isset($_SESSION['username'])) {
    if ($_SESSION['username'] == "Kijiroshi_Admin") {
        require_once("includes/updateSurvivorRatings.php");
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    <title>Dead by Daylight Buddy | <?= $_SESSION['category'] ?> List</title>
</head>

<body>
    <?php require_once("includes/menu.php") ?>

    <div class="main">
        <h1 class="text-center display-1"><a href="./">Dead by Daylight Buddy</a></h1>
        <p class="lead text-white text-center">List of all <strong>Survivors</strong> in the game, order by their ranking.<br>Note that, because survivors are mostly cosmetic, their ranking is equal to the sum of their teachables' rankings. </p>

        <div class="container mt-4">
            <div class="row">

                <?php $sql = 'SELECT * FROM ' . strtolower($_SESSION["category"]) . ' ORDER BY ranking DESC';
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
                while ($obj = $stmt->fetchObject()) {
                    ?><div class="col-6 col-md-3 col-lg-2">
                        <div class="card text-white border-bottom border-top rounded mb-2 text-center bg-dark">
                            <img class="card-img-top w-75 m-auto" src="imagens/<?php echo strtolower($_SESSION["category"]) ?>/<?= $obj->name; ?>_icon.png" alt="<?= $obj->name; ?> icon">
                            <div class="card-body text-center">
                                <h5 class="card-title text-center"><?= $obj->name; ?></h5>
                                <p class="card-text">Difficulty: <?= $obj->difficulty ?></p>
                                <p class="card-text" data-toggle="tooltip" title="The sum of <?= $obj->name ?>'s teachables rankings!">Ranking: <?= $obj->ranking ?></p>
                                <a href="#" class="btn btn-secondary">Profile (WIP)</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>

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

        <script>
            $(document).ready(function() {
                $(function() {
                    $('[data-toggle="popover"]').popover()
                });

                $(function() {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            })
        </script>
</body>

</html>