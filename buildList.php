<?php session_start();
if (!isset($_SESSION["category"])) {
    $_SESSION["category"] = "Survivor";
}
if (!isset($_SESSION["otcategory"])) {
    $_SESSION["otcategory"] = "Killer";
}

require_once("includes/connection.php");
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

    <title>Dead by Daylight Buddy | <?= $_SESSION['category'] ?> Build List</title>
</head>

<body>
    <?php require_once("includes/menu.php") ?>
    <script>
        function deleteBuild(buildId) {
            $("#topkek").append('<div class="shadow-lg text-center p-3 m-auto fixed-bottom bg-warning text-white"><i class="fas fa-sync fa-spin"></i> Your build is being deleted! Please wait while we update our information, we\'ll reload you automatically... <i class="fas fa-sync fa-spin"></i></div>');
            // A "please wait" div appears at fixed bottom
            $.ajax({
                type: 'POST',
                url: 'includes/deleteBuild.php',
                data: {
                    buildId: buildId
                },
                success: function(response) {
                    location.reload();
                }
            });
        }

        function seeBuild(buildId, buildName) {
            $("#topkek").append('<div class="shadow-lg text-center p-3 m-auto fixed-bottom bg-warning text-white"><i class="fas fa-sync fa-spin"></i> Please wait while we load the build ' + buildName + '! We\'ll reload you automatically... <i class="fas fa-sync fa-spin"></i></div>');

            window.location = 'build.php?build=' + buildId;
        }
    </script>

    <div class="main" id="topkek">
        <h1 class="text-center display-1"><a href="./">Dead by Daylight Buddy</a></h1>

        <div class="container mt-4">
            <p class="lead text-white text-center">List of all <strong><?= $_SESSION['category'] ?> Builds</strong> created by the <strong>Dead by Daylight Budddy</strong> community!</p>
            <?php $sql = 'SELECT * FROM builds WHERE category LIKE "' . $_SESSION["category"] . '" ORDER BY id DESC';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            while ($obj = $stmt->fetchObject()) {
                ?>
                <div class="row mb-2 border border-<?php if ($_SESSION["category"] == "Survivor") {
                                                        echo "success";
                                                    } else {
                                                        echo "danger";
                                                    }  ?> text-white">
                    <div class="col-2 border-right border-top border-bottom border-dark text-center m-auto rounded-right">
                        <img class="img-fluid" src="imagens/<?php echo strtolower($_SESSION["category"]) ?>/<?= $obj->buildCharacter ?>_icon.png">
                        <?php if ($_SESSION["category"] == "Killer") {
                            echo "The ";
                        } ?><?= $obj->buildCharacter ?>
                        <br>

                    </div>
                    <div class="col">
                        <div class="lead text-center font-weight-bolder"><?= $obj->buildName ?></div>
                        <div class="row text-center">
                            <div class="col-3 col-md-2"><img class="img-fluid" src="imagens/<?php echo strtolower($obj->category) ?>/perks/<?= trim(str_replace("Hex: ", "", $obj->perk1)); ?> 3.png"><?= $obj->perk1 ?></div>
                            <div class="col-3 col-md-2"><img class="img-fluid" src="imagens/<?php echo strtolower($obj->category) ?>/perks/<?= trim(str_replace("Hex: ", "", $obj->perk2)); ?> 3.png"><?= $obj->perk2 ?></div>
                            <div class="col-3 col-md-2"><img class="img-fluid" src="imagens/<?php echo strtolower($obj->category) ?>/perks/<?= trim(str_replace("Hex: ", "", $obj->perk3)); ?> 3.png"><?= $obj->perk3 ?></div>
                            <div class="col-3 col-md-2"><img class="img-fluid" src="imagens/<?php echo strtolower($obj->category) ?>/perks/<?= trim(str_replace("Hex: ", "", $obj->perk4)); ?> 3.png"><?= $obj->perk4 ?></div>
                        </div>
                        <div class="col-12 mt-4">
                            <span class="font-weight-bold">Introduction: </span><?= $obj->miniDescription ?>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-info" onclick="seeBuild(<?= $obj->id; ?>, '<?= $obj->buildName ?>')">See more!</button>
                        </div>
                        <div class="text-right">
                            <?php if (isset($_SESSION['username'])) {
                                if ($_SESSION['username'] == "Kijiroshi_Admin" || $_SESSION['username'] == $obj->createdBy) { ?>
                                    <button onclick="deleteBuild(<?= $obj->id ?>)" class="btn btn-danger" data-toggle="tooltip" title="Delete <?= $obj->buildName ?>"><i class="fas fa-trash-alt"></i></button>
                                <?php }
                        } ?><strong>Created by:</strong> <?= $obj->createdBy ?><br>
                            <em>
                                <?php
                                $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($obj->createdAt);

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
                                echo $time;
                                ?>
                            </em>
                        </div>
                    </div>
                </div>
            <?php } ?>
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